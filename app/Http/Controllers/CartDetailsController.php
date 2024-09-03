<?php

namespace App\Http\Controllers;

use App\Models\CartDetails;
use App\Http\Requests\StoreCartDetailsRequest;
use App\Http\Requests\UpdateCartDetailsRequest;

class CartDetailsController extends Controller
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
    public function store(StoreCartDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CartDetails $cartDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartDetails $cartDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartDetailsRequest $request, CartDetails $cartDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartDetails $cartDetails)
    {
        //
    }
}
