<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function show(Question $question)
{
    return view('questions.show', compact('question'));
}
}
