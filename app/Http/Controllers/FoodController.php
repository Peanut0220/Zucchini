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
        return view('adminonly.food.index', ['foods' => Food::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminonly.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        $file = $request->hasFile('thumbnail');
        if ($file) {
            $newFile = $request->file('thumbnail');
            $file_path = $newFile->store('images');
            Food::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image_path' => $file_path
            ]);

        }
        return redirect()->route('adminonly.food.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('adminonly.food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('adminonly.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFoodRequest $request, Food $food)
    {
        $file = $request->hasFile('thumbnail');
        if ($file) {
            $newFile = $request->file('thumbnail');
            $file_path = $newFile->store('images');
            $food->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image_path' => $file_path
            ]);

        }
        return redirect()->route('adminonly.food.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('adminonly.food.index');
    }

    public function test()
    {
        return dd(Food::all());
    }
}
