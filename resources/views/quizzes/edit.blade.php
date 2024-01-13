@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->name }} - Add Questions</h1>
    <p>Created by: {{ $quiz->user->name }}</p>
    <!-- Display quiz description -->
    <p>Description: {{ $quiz->Quizdescription }}</p>
   
    <textarea name="Quizdescription"></textarea>

    @if($quiz->image_link)
        <img src="{{ $quiz->image_link }}" alt="Quiz Image" style="max-width: 500px; max-height: 300px;">
    @endif

    <form method="post" action="{{ route('quizzes.update', $quiz) }}">
        @csrf

        <label for="question">Question:</label>
        <input type="text" name="question" required>

        <label for="answer_1">Answer 1:</label>
        <input type="text" name="answers[]" required>

        <label for="answer_2">Answer 2:</label>
        <input type="text" name="answers[]" required>

        <label for="answer_3">Answer 3:</label>
        <input type="text" name="answers[]" required>

        <label for="answer_4">Answer 4:</label>
        <input type="text" name="answers[]" required>

        <label for="correct_answer">Correct Answer:</label>
        <select name="correct_answer" required>
            <option value="1">Answer 1</option>
            <option value="2">Answer 2</option>
            <option value="3">Answer 3</option>
            <option value="4">Answer 4</option>
        </select>

        <button type="submit">Add Question</button>
    </form>

     

    <!-- Display existing questions -->
    @forelse($questions as $question)
        <div>
            <p>{{ $question->order }}. {{ $question->text }}</p>
        </div>
    @empty
        <p>No questions added yet.</p>
    @endforelse


    <!-- Finish Creating Questions Button -->
    <form method="post" action="{{ route('quizzes.finish', $quiz) }}">
        @csrf
        <button type="submit">Finish Creating Questions</button>
    </form>
@endsection