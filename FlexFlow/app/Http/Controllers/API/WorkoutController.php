<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    /**
     * GET
     */
    public function index()
    {
        $workouts = Workout::with('exercises')->get();
        return response()->json($workouts);
    }

    /**
     * POST
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'userid' => 'required|exists:users,userid',
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'exercises' => 'required|array',
            'exercises.*.exerciseid' => 'required|exists:exercise,exerciseid',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
        ]);
         $workout = Workout::create([
            'userid' => $validated['userid'],
            'date' => $validated['date'],
            'notes' => $validated['notes'] ?? null,
        ]);
         foreach ($validated['exercises'] as $exercise) {
            $workout->exercises()->attach($exercise['exerciseid'], [
                'sets' => $exercise['sets'],
                'reps' => $exercise['reps']
            ]);
        }
        return response()->json([
            'message' => 'Workout created successfully.',
            'workout' => $workout->load('exercises')
        ], 201);
    }

    /**
     * GET po idu
     */
    public function show(string $id)
    {
        $workout = Workout::with('exercises')->find($id);
        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        }
        return response()->json($workout);
    }

    /**
     * PUT po idu
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'date' => 'sometimes|date',
            'notes' => 'nullable|string',
            'exercises' => 'sometimes|array',
            'exercises.*.exerciseid' => 'required|exists:exercise,exerciseid',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
        ]);

        $workout = Workout::findOrFail($id);
        $workout->update($validated);

        if (isset($validated['exercises'])) {
            $syncData = [];
            foreach ($validated['exercises'] as $exercise) {
                $syncData[$exercise['exerciseid']] = [
                    'sets' => $exercise['sets'],
                    'reps' => $exercise['reps']
                ];
            }
            $workout->exercises()->sync($syncData);
        }

        return response()->json([
            'message' => 'Workout updated successfully.',
            'workout' => $workout->load('exercises')
        ]);
    }

    /**
     * DELETE po idu
     */
    public function destroy(string $id)
    {
        $workout = Workout::findOrFail($id);
        $workout->delete();
        return response()->json(['message' => 'Workout deleted successfully.']);
    }
}
