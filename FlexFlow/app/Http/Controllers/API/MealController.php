<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meal;

class MealController extends Controller
{
    /**
     * GET
     */
    public function index()
    {
        return response()->json(Meal::all());
    }

    /**
     * POST
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'userid' => 'required|exists:users,userid',
            'date' => 'required|date',
            'meal_name' => 'required|string',
            'weight' => 'required|integer|min:1',
        ]);
        $meal = Meal::create($validated);
        return response()->json($meal, 201);
    }

    /**
     * GET po idu
     */
    public function show(string $id)
    {
        $meal = Meal::find($id);
        if (!$meal) {
            return response()->json(['error' => 'Meal not found'], 404);
        }
        return response()->json($meal);
    }

    /**
     * PUT po idu
     */
    public function update(Request $request, string $id)
    {
        $meal = Meal::find($id);
        if (!$meal) {
            return response()->json(['error' => 'Meal not found'], 404);
        }
        $meal->update($request->all());
        return response()->json($meal);
    }

    /**
     * DELETE po idu
     */
    public function destroy(string $id)
    {
        $meal = Meal::find($id);
        if (!$meal) {
            return response()->json(['error' => 'Meal not found'], 404);
        }
        $meal->delete();
        return response()->json(['message' => 'Meal deleted']);
    }
}
