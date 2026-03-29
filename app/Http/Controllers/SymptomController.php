<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index(Request $request)
    {
        $symptoms = Symptom::where('user_id', $request->user()->id)->get();

        return response()->json([
            'success' => true,
            'data' => $symptoms,
            'message' => 'ok'
        ]);
    }

    public function store(Request $request)
    {
        $symptom = Symptom::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'severity' => $request->severity,
            'description' => $request->description,
            'date_recorded' => $request->date_recorded,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'created'
        ]);
    }

    public function show(Request $request, $id)
    {
        $symptom = Symptom::where('user_id', $request->user()->id)->find($id);

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'ok'
        ]);
    }

    public function update(Request $request, $id)
    {
        $symptom = Symptom::where('user_id', $request->user()->id)->find($id);

        $symptom->update([
            'name' => $request->name,
            'severity' => $request->severity,
            'description' => $request->description,
            'date_recorded' => $request->date_recorded,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'updated'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $symptom = Symptom::where('user_id', $request->user()->id)->find($id);
        $symptom->delete();

        return response()->json([
            'success' => true,
            'message' => 'deleted'
        ]);
    }
}