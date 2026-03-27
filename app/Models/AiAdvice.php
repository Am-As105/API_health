<?php

namespace App\Models;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Model;

class AiAdvice extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function symptoms()
{
    return $this->belongsToMany(Symptom::class);
}
}
