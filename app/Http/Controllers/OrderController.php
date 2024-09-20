<?php

namespace App\Http\Controllers;

use App\Iterator\ConcreteAggregate;
use App\Models\banks;
use App\Models\Cart;
use App\Models\CouponUsage;
use App\Models\Delivery;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetails;
use App\Models\XSLTTransformation;
use App\Strategy\PaymentContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all()->toArray();
        $orderAggregate = new ConcreteAggregate($orders);
        $orderIterator = $orderAggregate->iterator();
        return view('adminonly.order.index', compact('orderIterator')); // Pass the $foods variable to the admin view

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function __construct(XMLController $xmlController)
    {
        $this->xmlController = $xmlController;
    }

    public function displayTransformedXML()
    {

        $xmlPath = $this->xmlController->xmlOrderList();

        if (!is_string($xmlPath)) {
            return $xmlPath; // Forward the error response if not a string
        }

        $transformer = new XSLTTransformation();
        $xslPath = public_path('xml/orders.xsl');
        $output = $transformer->transform($xmlPath, $xslPath);

        return response($output, 200, ['Content-Type' => 'text/html']);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($orderId)
    {
        $order = Order::with('details', 'delivery')->where('order_id', $orderId)->firstOrFail();
        return view('adminonly.order.show', ['order' => $order, 'delivery' => $order->delivery]);

    }

    public function cusShow($orderId)
    {
        $order = Order::with('details', 'delivery')->where('order_id', $orderId)->firstOrFail();
        return view('custonly.orderShow', ['order' => $order, 'delivery' => $order->delivery]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function checkout(StoreOrderRequest $request)
    {

        if($request->input('card_number') != null){
            $exists = banks::where('card_number', $request->input('card_number'))->first();
            if(!($exists && $exists->expiration_date = $request->input('expiration_date') && $exists->cvv = $request->input('cvv'))){
                return redirect()->route('checkout')->with('error','Invalid card information');
            }
        }

        $userId = Auth::id();

        // Retrieve the user's cart
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }
        $couponId = $request->input('voucher_id');

        $total = $cart->total;
        $discount = $request->input('voucher_discount') * $total;
        $tax = ($total - $discount) * 0.06;
        $final = $this->calculateFinalAmount($total);

        $paymentType = "";
        if ($request->input('payment_method') === 'CC') {
            $paymentType = 'Credit Card';
        } else if ($request->input('payment_method') === 'EW') {
            $paymentType = 'Ewallet';
        } else if ($request->input('payment_method') === 'COD') {
            $paymentType = 'Cash On Delivery';
        }

        // Create a new order and store payment method
        $order = Order::create([
            'user_id' => $userId,
            'payment_type' => $paymentType, // Store payment method
            'total' => number_format($total, 2),
            'tax' => number_format($tax, 2),
            'discount' => number_format($discount, 2),
            'final' => number_format($final, 2)
        ]);

        if ($couponId) {
            CouponUsage::create([
                'coupon_id' => $couponId,
                'user_id' => $userId
            ]);
        }

        // Copy cart details to order details
        foreach ($cart->cartDetails as $cartDetail) {
            OrderDetails::create([
                'order_id' => $order->order_id,
                'food_id' => $cartDetail->food_id,
                'price' => number_format($cartDetail->food->price, 2),
                'quantity' => $cartDetail->quantity,
                'subtotal' => number_format($cartDetail->subtotal, 2),
            ]);
        }



        // Create delivery record
        Delivery::create([
            'address' => $request->input('street_address'),
            'status' => 'Pending',
            'rider' => $request->input('rider'),
            'order_id' => $order->order_id,
        ]);

        // Clear the cart
        $cart->cartDetails()->delete();
        $cart->total = 0;
        $cart->save();

        // Process payment
        $paymentResult = $this->processPayment($request->input('payment_method'), $final);

        if ($couponId) {
            CartController::removeVoucher();
        }

        // Pass both success message and payment result to the session
        return redirect()->route('orderList')
            ->with('success', 'Your order has been placed successfully!')
            ->with('paymentResult', $paymentResult);
    }


    private function processPayment($paymentType, $amount)
    {
        $paymentContext = new PaymentContext($paymentType);
        return $paymentContext->processPayment($amount); // Returning payment result
    }


    // Helper function to calculate the final amount (total + tax - discount)
    private function calculateFinalAmount($total)
    {
        return number_format(($total - number_format(number_format($total, 2)* session('voucher_discount'),2))*1.06,2);
    }



}
