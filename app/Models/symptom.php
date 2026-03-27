<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aiAdvices()
    {
        return $this->belongsToMany(AiAdvice::class);
    }
}
