<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::where('user_id',$request->user()->id)->get();
        return response()->json(['success'=>true,'data'=>$appointments,'message'=>'ok']);
    }

    public function store(Request $request)
    {
        $appointment = Appointment::create([
            'user_id'=>$request->user()->id,
            'doctor_id'=>$request->doctor_id,
            'appointment_date'=>$request->appointment_date,
            'status'=>$request->status ?? 'pending',
            'notes'=>$request->notes,
        ]);
        return response()->json(['success'=>true,'data'=>$appointment,'message'=>'created']);
    }

    public function show(Request $request,$id)
    {
        $appointment = Appointment::where('user_id',$request->user()->id)->find($id);
        return response()->json(['success'=>true,'data'=>$appointment,'message'=>'ok']);
    }

    public function update(Request $request,$id)
    {
        $appointment = Appointment::where('user_id',$request->user()->id)->find($id);
        $appointment->update($request->only(['doctor_id','appointment_date','status','notes']));
        return response()->json(['success'=>true,'data'=>$appointment,'message'=>'updated']);
    }

    public function destroy(Request $request,$id)
    {
        $appointment = Appointment::where('user_id',$request->user()->id)->find($id);
        $appointment->delete();
        return response()->json(['success'=>true,'message'=>'deleted']);
    }
}