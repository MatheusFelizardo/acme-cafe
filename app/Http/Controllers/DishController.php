<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::with('categories')->get()->map(function ($dish) {
            $dish->categories->transform(function ($category) {
                return ['id' => $category->id, 'name' => $category->name];
            });
        
            return $dish;
        });

        return response()->json($dishes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required'
        ]);

        $has_name = Dish::where('name', $request->name)->first();

        if ($has_name) {
            return response()->json(['message' => 'Dish already exists.'], 400);
        }

        return Dish::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $dish = Dish::find($id);
        $dish->load('categories');

        if (!$dish) {
            return response()->json(['message' => 'Dish not found.'], 404);
        }

        return response()->json($dish);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $is_valid = $request->validate([
            'name' => 'string',
            'description' => 'string',
            'price' => 'numeric',
            'is_active' => 'boolean',
            'featured' => 'boolean'
        ]);

        if (!$is_valid) {
            return response()->json(['message' => 'Invalid data format in the request body'], 400);
        }

        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found.'], 404);
        }

        $dish->update($request->all());
        return response()->json($dish);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found.'], 404);
        }

        $dish->delete();
        return response()->json(['message' => 'Dish deleted.']);
    }

    /**
     * List all dishes category.
     */

    public function categories() {
        $categories = FoodCategory::with('dishes')->get()->map(function ($category) {
            $category->dishes->transform(function ($dish) {
                return ['id' => $dish->id, 'name' => $dish->name, 'price' => $dish->price];
            });
        
            return $category;
        });
        
        return response()->json($categories);
    }

    /*
    * Associate a category to a dish.
    */

    public function associate_category(Request $request, int $id) {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found.'], 404);
        }

        $category = FoodCategory::find($request->food_category_id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $already_associated = DishCategory::where('dish_id', $id)->where('food_category_id', $request->food_category_id)->first();

        if ($already_associated) {
            return response()->json(['message' => 'Category already associated to dish.'], 400);
        }

        $dish->categories()->attach($category->id);
        $dish->touch();
        return response()->json(['message' => 'Category associated to dish.', 'dish' => $dish, 'category' => $category]);
    }

    public function edit_associated_category(Request $request, int $id) {
        $dish_category = DishCategory::where('dish_id', $id)->where('food_category_id', $request->old_category)->first();
        
        if (!$dish_category) {
            return response()->json(['message' => 'Category not associated to dish.'], 404);
        }

        $dish_category->food_category_id = $request->new_category;
        $dish_category->save();
        return response()->json(['message' => 'Category updated.', 'dish_category' => $dish_category]);
    }

    public function remove_associated_category( int $dishId, int $categoryId) {
        $dish = Dish::find($dishId);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found.'], 404);
        }

        $dish_category = DishCategory::where('dish_id', $dishId)->where('food_category_id', $categoryId)->first();
        if (!$dish_category) {
            return response()->json(['message' => 'Category not associated to dish.'], 404);
        }

        $dish->categories()->detach($categoryId);
        return response()->json(['message' => 'Category dissassociated from the dish.', 'dish_category' => $dish_category]);

    }
}
