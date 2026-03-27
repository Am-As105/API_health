<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request )
    {
        $appointments = Appointment::with('doctor')
            ->where('user_id', $request->user()->id)
            ->get();
             return response()->json([
            'success' => true,
            'data' => $appointments,
            'message' => 'List of appointments'
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'user_id' => $request->user()->id,
            'doctor_id' => $validated['doctor_id'],
            'appointment_date' => $validated['appointment_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);
        return response()->json([
            'success' => true,
            'data' => $appointment,
            'message' => 'Appointment created'
        ]);
    }
    public function show (Request $request , $id)
    {
        $appointment = Appointment::with('doctor')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$appointment)
        {
            return response()->([
                

                
            ])
        }

    }
}
