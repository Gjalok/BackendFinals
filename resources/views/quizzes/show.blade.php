@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->name }}</h1>

    @if($quiz->image_link)
        <img src="{{ $quiz->image_link }}" alt="Quiz Image" style="max-width: 500px; max-height: 300px;">
    @endif

    <form method="post" action="{{ route('quizzes.submit', $quiz) }}">
        @csrf

        @foreach($questions as $question)
            <div>
                <p>{{ $question->order }}. {{ $question->text }}</p>

                <!-- Display radio buttons for answer options -->
                @foreach($question->options as $optionNumber => $option)
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $optionNumber }}"
                               {{ old("answers.{$question->id}") == $optionNumber ? 'checked' : '' }}>
                        {{ $option }}
                    </label>
                @endforeach
            </div>
        @endforeach

        <button type="submit">Submit Quiz</button>
    </form>
@endsection


