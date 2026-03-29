<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\Advice;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function generateAdvice(Request $request)
    {
        $symptoms = Symptom::where('user_id',$request->user()->id)->pluck('name')->toArray();
        $adviceText = "Generated advice for symptoms: ".implode(", ",$symptoms);

        $advice = Advice::create([
            'user_id'=>$request->user()->id,
            'advice'=>$adviceText,
            'symptoms'=>json_encode($symptoms),
            'generated_at'=>now()
        ]);

        return response()->json(['success'=>true,'data'=>$advice,'message'=>'ok']);
    }
     public function history(Request $request)
    {
        $history = Advice::where('user_id',$request->user()->id)->get();
        return response()->json(['success'=>true,'data'=>$history,'message'=>'ok']);
    }

   
}