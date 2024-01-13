<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizModel extends Model
{

    protected $fillable = [
        'text','name' // Add any other attributes you want to allow for mass assignment
    ];
    use HasFactory;
}
