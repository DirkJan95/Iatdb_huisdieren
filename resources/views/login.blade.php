@extends('loginLayout')

@section('content')


<div class="container">
    <h1>Passen op je dier!</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autofocus>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
        </div>

        <div class='buttonContainer'>
            <button type="submit">Login</button>
        </div>
    </form>
</div>


@endsection