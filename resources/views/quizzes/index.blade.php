@extends('layouts.app')

@section('content')
    <h1>Latest Quizzes</h1>

    <!-- Form to add a new quiz -->
    <form method="post" action="{{ route('quizzes.store') }}">
        @csrf

        <label for="quiz_name">Name of the Quiz:</label>
        <input type="text" name="quiz_name" required>

<label for="image_link">Image web Link:</label>
<input type="text" name="image_link">

        <button type="submit">Create Quiz</button>
        <input type="hidden" name="options" value="[]"> <!-- Provide a default value for options -->
    </form>

    <!-- Display existing quizzes -->
    @forelse($quizzes as $quiz)
        <div>
            <h2>{{ $quiz->name }}</h2>

            <p>Created by: {{ $quiz->user->name }}</p>

            <p>Number of Questions: {{ $quiz->questions_count }}</p>

            <p>Correct Answers: {{ $correctAnswersCount }}</p>
            
            <p>Quizdescription: {{ $quiz->Quizdescription }}</p>

            @if($quiz->image_link)
            <img src="{{ $quiz->image_link }}" alt="Quiz Image" style="max-width: 300px; max-height: 200px;">
        @endif

        <form method="post" action="{{ route('quizzes.destroy', $quiz->id) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Quiz</button>
        </form>

        

            <p>{{ $quiz->created_at->diffForHumans() }}</p>
            <a href="{{ route('quizzes.show', $quiz) }}">Start Quiz</a>
        </div>
    @empty
        <p>No quizzes available.</p>
    @endforelse
@endsection