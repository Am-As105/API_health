<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;



class SymptomController extends Controller
{
    public function index(Request $request)
    {
        $symptoms = $request->user()->symptoms;

        return response()->json([
            'success' => true,
            'data' => $symptoms,
            'message' => 'List of symptoms'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'severity' => 'required|in:mild,moderate,severe',
            'description' => 'nullable|string',
            'date_recorded' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $symptom = $request->user()->symptoms()->create($validated);

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'Symptom created'
        ]);
    }

    public function show(Request $request, $id)
    {
        $symptom = Symptom::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$symptom) {
            return response()->json([
                'success' => false,
                'message' => 'Symptom not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'Symptom details'
        ]);
    }

    public function update(Request $request, $id)
    {
        $symptom = Symptom::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$symptom) {
            return response()->json([
                'success' => false,
                'message' => 'Symptom not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'severity' => 'sometimes|in:mild,moderate,severe',
            'description' => 'nullable|string',
            'date_recorded' => 'sometimes|date',
            'notes' => 'nullable|string',
        ]);

        $symptom->update($validated);

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'Symptom updated'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $symptom = Symptom::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$symptom) {
            return response()->json([
                'success' => false,
                'message' => 'Symptom not found'
            ], 404);
        }

        $symptom->delete();

        return response()->json([
            'success' => true,
            'message' => 'Symptom deleted'
        ]);
    }
}
}
