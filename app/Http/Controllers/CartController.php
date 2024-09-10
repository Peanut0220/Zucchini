<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\CartDetails;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the current user
        $user = Auth::user();

        // Check if the user already has an active cart
        $userId = auth()->user()->user_id; // Assuming 'user_id' is a custom ID
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            // If no active cart, create a new one
            $cart = Cart::create([
                'cart_id' => $this->generateCartId(),
                'user_id' => $userId,
                'total' => 0, // Total will be updated later
            ]);
        }

        // Fetch the user's cart, along with cart details and the associated food items
        $cart = Cart::where('user_id', $user->user_id)
            ->with('cartDetails.food') // Eager load the food items in cart details
            ->first();


        // Pass the cart to the view
        return view('custonly.cart', [
            'cart' => $cart,
        ]);
    }

    public function addToCart(Request $request, $food_id)
    {
        // Find the food item
        $food = Food::findOrFail($food_id);

        // Check if the user already has an active cart
        $userId = auth()->user()->user_id; // Assuming 'user_id' is a custom ID
        $cart = Cart::where('user_id', $userId)->first();


        // Check if the food is already in the cart details
        $cartDetail = CartDetails::where('cart_id', $cart->cart_id)
            ->where('food_id', $food->food_id)
            ->first();

        $quantity = $request->input('quantity', 1); // Get the quantity from the request

        if ($cartDetail) {
            // Update the quantity and subtotal if the item already exists in the cart
            $cartDetail->quantity += $quantity;
            $cartDetail->subtotal = $cartDetail->quantity * $food->price;
            $cartDetail->save();
        } else {
            // Add new item to cart details
            CartDetails::create([
                'cartDetail_id' => $this->generateCartDetailId(),
                'cart_id' => $cart->cart_id,
                'food_id' => $food->food_id,
                'quantity' => $quantity,
                'subtotal' => $quantity * $food->price,
            ]);
        }

        // Update cart total
        $cart->total = CartDetails::where('cart_id', $cart->cart_id)->sum('subtotal');
        $cart->save();

        return redirect()->route('cart')->with('success', 'Item added to cart');
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
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Find the cart item to be updated
        $cartDetail = CartDetails::where('cartDetail_id', $request->input('cartDetail_id'))->first();

        if (!$cartDetail) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        // Fetch the cart the item belongs to
        $cart = Cart::where('cart_id', $cartDetail->cart_id)->first();
        $action = $request->input('action');
        $newQuantity = $request->input('quantity');

        // Check if the action is 'delete' or if the quantity is set to zero
        if ($action === 'delete' || $newQuantity == 0) {
            // Delete the item first
            $cartDetail->delete();

            // Recalculate the cart total after the item is deleted
            if ($cart) {
                $cart->total = CartDetails::where('cart_id', $cart->cart_id)->sum('subtotal');
                $cart->save();
            }

            // Add logging to confirm the deletion and update
            \Log::info('Item deleted and cart total updated: ', ['cart_id' => $cart->cart_id, 'new_total' => $cart->total]);

        } elseif ($action !== 'delete' && $newQuantity > 0) {
            // Update item quantity and subtotal
            $cartDetail->quantity = $newQuantity;
            $cartDetail->subtotal = $newQuantity * $cartDetail->food->price;
            $cartDetail->save();

            // Recalculate the cart total after the update
            if ($cart) {
                $cart->total = CartDetails::where('cart_id', $cart->cart_id)->sum('subtotal');
                $cart->save();
            }
        }

        // Redirect after the update
        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }


    public function clear()
    {
        // Get the current cart and clear all items
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->cartDetails()->delete(); // Clear all cart details
            $cart->total = 0;
            $cart->save();
        }

        return redirect()->back()->with('success', 'All items cleared from the cart.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cartDetailId)
    {
        // Find the cart detail and delete it
        $cartDetail = CartDetails::findOrFail($cartDetailId);
        $cartId = $cartDetail->cart_id;

        $cartDetail->delete();

        // Recalculate and update the cart total
        $cart = Cart::where('cart_id', $cartId)->first();
        if ($cart) {
            $cart->total = CartDetails::where('cart_id', $cartId)->sum('subtotal');
            $cart->save();
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }


    // Generate a custom cart ID
    private function generateCartId()
    {
        $prefix = 'C';
        $lastCart = Cart::orderBy('cart_id', 'desc')->first();
        $number = $lastCart ? (int)substr($lastCart->cart_id, 1) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    // Generate a custom cart detail ID
    private function generateCartDetailId()
    {
        $prefix = 'CD';
        $lastCartDetail = CartDetails::orderBy('cartDetail_id', 'desc')->first();
        $number = $lastCartDetail ? (int)substr($lastCartDetail->cartDetail_id, 2) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
