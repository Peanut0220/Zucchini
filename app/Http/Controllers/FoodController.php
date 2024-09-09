<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    // Admin view for listing foods
    public function index()
    {
        $foods = Food::all(); // Fetch all food items
        return view('adminonly.food.index', compact('foods')); // Pass the $foods variable to the admin view
    }

    // Customer view for listing foods
    public function customerMenu(Request $request)
    {
        $query = Food::query();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $foods = $query->paginate(9);

        // Assuming categories are predefined and accessible here
        $categories = Category::all(); // Or use your category model

        return view('custonly.menu', compact('foods', 'categories'));
    }




    public function create()
    {
        $categories = Category::all(); // Fetch all categories

        return view('adminonly.food.create', compact('categories')); // Pass categories to view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        $filePath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filePath = $file->store('images');
        }

        Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'price' => $request->price,
            'image_path' => $filePath
        ]);

        return redirect()->route('food.index')->with('success', 'Food created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function showCus(Food $food)
    {
        return view('custonly.foodDetail', compact('food'));
    }

    public function showAdmin(Food $food)
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
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $filePath = $food->image_path;
        if ($request->hasFile('thumbnail')) {
            // Delete the old file if it exists
            if ($filePath) {
                Storage::delete($filePath);
            }

            $file = $request->file('thumbnail');
            $filePath = $file->store('images');
        }

        $food->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $filePath,
        ]);

        return redirect()->route('adminonly.food.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        // Delete the file if it exists
        if ($food->image_path) {
            Storage::delete($food->image_path);
        }

        $food->delete();
        return redirect()->route('adminonly.food.index');
    }

    public function test()
    {
        return dd(Food::all());
    }
}
