<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
        }
        h1 {
            font-size: 50px;
        }
        p {
            font-size: 20px;
        }
        a {
            text-decoration: none;
            color: #3490dc;
        }
    </style>
</head>
<body>
<h1>404</h1>
<p>Sorry, the page you are looking for could not be found.</p>
@if (auth()->check())
    @if (auth()->user()->role === 'customer')
        <a href="{{ url('/home') }}">Go back to Home</a>
    @elseif (auth()->user()->role === 'staff')
        <a href="{{ url('/dashboard') }}">Go back to Dashboard</a>
    @else
        <a href="{{ url('/welcome') }}">Go back to Home</a> <!-- Default for any other role -->
    @endif
@else
    <a href="{{ url('/welcome') }}">Go back to Home</a> <!-- For guests, redirect to home -->
@endif
</body>
</html>
