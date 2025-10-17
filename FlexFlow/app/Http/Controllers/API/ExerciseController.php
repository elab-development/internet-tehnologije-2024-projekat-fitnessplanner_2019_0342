<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    /**
     * GET
     */
    public function index()
    {
        return response()->json(Exercise::all());
    }

    /**
     * POST
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'targeted_muscle' => 'required|string',
            'video_url' => 'nullable|string',
        ]);
        $exercise = Exercise::create($validated);
        return response()->json($exercise, 201);
    }

    /**
     * GET po idu
     */
    public function show(string $id)
    {
        $exercise = Exercise::find($id);
        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404);
        }
        return response()->json($exercise);
    }

    /**
     * PUT po idu
     */
    public function update(Request $request, string $id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404);
        }
        $exercise->update($request->all());
        return response()->json($exercise);
    }

    /**
     * DELETE po idu
     */
    public function destroy(string $id)
    {
        $exercise = Exercise::find($id);
        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404);
        }
        $exercise->delete();
        return response()->json(['message' => 'Exercise deleted']);
    }
}
