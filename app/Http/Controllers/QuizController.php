<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\QuizFeedback;



class QuizController extends Controller
{


   
   
    public function index()
{


    $correctAnswersCount = session('correctAnswersCount', 0);

    // Fetch the latest quizzes or any other logic you have for displaying quizzes
    $quizzes = Quiz::orderBy('created_at', 'desc')->take(5)->get();

    $quizzes = Quiz::orderBy('created_at', 'desc')->get();

    $quizzes = Quiz::withCount('questions')->latest()->get();

    

    
    return view('quizzes.index', compact('quizzes', 'correctAnswersCount'));
   
}



public function show(Quiz $quiz)
{
    $questions = $quiz->questions;
    return view('quizzes.show', compact('quiz', 'questions'));
}



public function create()
{
    return view('quizzes.create');
}


public function destroy($id)
{
    // Find the quiz
    $quiz = Quiz::findOrFail($id);

    // Delete related questions
    Question::where('quiz_id', $id)->delete();

    // Delete the quiz
    $quiz->delete();

    return redirect()->route('quizzes.index')
        ->with('success', 'Quiz and related questions deleted successfully');
}





public function store(Request $request)
{

    $validatedData = $request->validate([
        'quiz_name' => 'required|string|max:255',
        'image_link' => 'nullable|url',
    ]);

    

    $quiz = new Quiz();
    $quiz->name = $request->input('name');
    $quiz->description = $request->input('Quizdescription');


    $quiz = Quiz::create([
        'name' => $validatedData['quiz_name'],
        'image_link' => $validatedData['image_link'],
    ]);


     $quiz->user()->associate(Auth::user());

     $quiz->save();

    return redirect()->route('quizzes.edit', $quiz);
}






public function edit(Quiz $quiz)
{
    $questions = $quiz->questions;
    return view('quizzes.edit', ['quiz' => $quiz, 'questions' => $questions]);
}




public function update(Request $request, Quiz $quiz)
{
    $validatedData = $request->validate([
        'question' => 'required|string|max:255',
        'answers' => 'required|array|size:4',
        'answers.*' => 'required|string|max:255',
        'correct_answer' => 'required|numeric|in:1,2,3,4',
    ]);

    $order = $quiz->questions()->count() + 1;

    $question = new Question([
        'text' => $validatedData['question'],
        'options' => $validatedData['answers'],
        'correct_answer' => $validatedData['correct_answer'],
        'order' => $order,
    ]);

    $quiz->questions()->save($question);

    

    return redirect()->route('quizzes.edit', $quiz);
}




public function finish(Quiz $quiz)
{
    return redirect()->route('quizzes.index');
}



public function submit(Request $request, Quiz $quiz)
{
    // Assuming your form has an input field named 'answers'
    $quizSubmission = $request->input('answers');

    $correctAnswersCount = $this->calculateCorrectAnswers($quiz, $quizSubmission);

    // Store correct answers count in the session
    session(['correctAnswersCount' => $correctAnswersCount]);

    return redirect()->route('quizzes.index', ['quiz' => $quiz]);
   
}





private function calculateCorrectAnswers(Quiz $quiz, $userAnswers)
{
    $questions = $quiz->questions;
    $correctAnswersCount = 0;

    foreach ($questions as $question) {
        // Check if the user provided an answer for this question
        if (isset($userAnswers[$question->id])) {
            // Check if the user's answer matches the correct answer
            if ($userAnswers[$question->id] == $question->correct_option) {
                $correctAnswersCount++;
            }
        }
    }

    return $correctAnswersCount;
}


}