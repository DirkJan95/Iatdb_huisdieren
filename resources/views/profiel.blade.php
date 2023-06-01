@extends('layout')

@section('content')

<h1>test</h1>

<img src="{{ $user->house_pictures }}" alt="house" style="width:100%"/>

@if(auth()->user()->id == $user->id)
    <h1>Mijn account test</h1>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="house_pictures">House Pictures:</label>
        <input type="file" name="house_pictures" id="house_pictures">
    
        <button type="submit">Update House Pictures</button>
    </form>
@endif

@endsection

