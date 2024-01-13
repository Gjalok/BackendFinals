@extends('layouts.app')



@section('content')


    <h1>Create a New Quiz</h1>

    <form method="post" action="{{ route('quizzes.store') }}">
        @csrf

        <label for="quiz_name">Quiz Name:</label>
        <input type="text" name="quiz_name" required>

        <label for="Quizdescription">Quiz Description:</label>
        <textarea name="Quizdescription"></textarea>
        
        <label for="question">Question:</label>
        <input type="text" name="question" required>

        <label for="answers">Answers (comma-separated):</label>
        <input type="text" name="answers" required>

        <label for="correct_answer">Correct Answer:</label>
<select name="correct_answer" required>
    <option value="1">Answer 1</option>
    <option value="2">Answer 2</option>
    <option value="3">Answer 3</option>
    <option value="4">Answer 4</option>
</select>

<label for="image_link">Image Link:</label>
<input type="text" name="image_link">





        <button type="submit">Create Quiz</button>
        <input type="hidden" name="options" value="[]"> <!-- Provide a default value for options -->
    </form>
    
    <a href="{{ route('quizzes.index') }}">Back to Quizzes</a>
@endsection