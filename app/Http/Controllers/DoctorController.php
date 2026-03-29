<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json(['success'=>true,'data'=>$doctors,'message'=>'ok']);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        return response()->json(['success'=>true,'data'=>$doctor,'message'=>'ok']);
    }

    public function search(Request $request)
    {
        $query = Doctor::query();
        if($request->has('specialty')) $query->where('specialty',$request->specialty);
        if($request->has('city')) $query->where('city',$request->city);
        $doctors = $query->get();
        return response()->json(['success'=>true,'data'=>$doctors,'message'=>'ok']);
    }
}