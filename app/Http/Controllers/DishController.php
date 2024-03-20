<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::all();
        return response()->json($dishes);
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
}
