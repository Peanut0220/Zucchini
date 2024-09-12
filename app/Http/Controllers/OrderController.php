<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Delivery;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    public function checkout(Request $request)
    {
        $userId = Auth::id();

        // Retrieve the user's cart
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $total = $cart->total;
        $tax = $this->calculateTax($total);
        $discount = 0;
        $final = $this->calculateFinalAmount($total, $tax, $discount);

        // Create a new order
        $order = Order::create([
            'user_id' => $userId,
            'total' => number_format($total, 2),
            'tax' => number_format($tax, 2),
            'discount' => number_format($discount, 2),
            'final' => number_format($final, 2),
        ]);

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

        // Create a new delivery and attach the observer
        $deliverySubject = new \App\Observer\ConcreteSubject();  // ConcreteSubject instance
        $customerObserver = new \App\Observer\ConcreteObserver(); // ConcreteObserver instance
        $deliverySubject->attach($customerObserver);

        $delivery = Delivery::create([
            'address' => $request->input('street_address'),
            'status' => 'Pending',
            'rider' => $request->input('rider'),
            'order_id' => $order->order_id,
        ]);

        // Set the delivery state and notify observers
        $deliverySubject->setState($delivery->status);

        // Clear the cart
        $cart->cartDetails()->delete();
        $cart->total = 0;
        $cart->save();

        return redirect()->route('menu')
            ->with('success', 'Your order has been placed successfully!');
    }


    // Helper function to calculate tax (10% for now)
    private function calculateTax($total)
    {
        return number_format($total * 0.06, 2);
    }

    // Helper function to calculate the final amount (total + tax - discount)
    private function calculateFinalAmount($total, $tax, $discount)
    {
        return number_format($total + $tax - $discount, 2);
    }



}
