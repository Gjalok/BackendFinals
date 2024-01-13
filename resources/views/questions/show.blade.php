@extends('layouts.app')

@section('content')
    <h1>{{ $question->text }}</h1>
    @foreach($question->options as $option)
        <label>
            <input type="radio" name="answer" value="{{ $option }}">{{ $option }}
        </label>
    @endforeach
    <a href="{{ route('quizzes.show', $question->quiz) }}">Back to Quiz</a>
@endsection