<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Quiz Platform</title>
    <!-- Add your styles or scripts here -->
</head>
<body>
    @yield('content')
</body>
</html>

@guest
    <a href="{{ route('login') }}">Login</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
    @endif
@else
    <!-- Display user name or other authenticated user information -->
@endguest