<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('food.index', ['foods' => Food::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        Food::create($request->all());
        return redirect()->route('food.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFoodRequest $request, Food $food)
    {
        $food->update($request->all());
        return redirect()->route('food.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('food.index');
    }

    public function test(){
        return dd(Food::all());
    }
}
