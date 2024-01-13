<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = [
        'text','name',
        'options',
        'correct_answer',
        'order',// Add any other attributes you want to allow for mass assignment
    ];

    protected $casts = [
        'options' => 'array',
    ];
    use HasFactory;
}
