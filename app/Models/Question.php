<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table='questions';

    public function surveys(){
        return $this->belongsTo(Survey::class);
    }

      public function options(){
        return $this->hasMany(Option::class);
    }

      public function answers()
    {
        return $this->hasOne(Answer::class);
    }
}
