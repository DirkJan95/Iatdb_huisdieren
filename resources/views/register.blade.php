@extends('loginLayout')

@section('content')


<div class="container">
    <h1>Register</h1>
    <h3>PassenOpJeDier!</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autofocus>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class='buttonContainer'>
            <button type="submit">Register</button>
        </div>
    </form>
</div>


@endsection