@extends('layout')

@section('content')

<h1>Profiel</h1>    
<div class="profile-container">
    <h2>Reviews</h2>
    @if ($user->reviews->count() > 0)
        <ul>
            @foreach ($user->reviews as $review)
                <li>
                    <p>{{ $review->review }}</p>                    
                </li>
            @endforeach
        </ul>
    @else
        <p>No reviews yet.</p>
    @endif
    <div class="profile-info">
        <p><strong>Name:</strong> {{ $user->name }}</p>            
    </div>
    <img src="{{ $user->house_pictures ? $user->house_pictures : 'http://127.0.0.1:8000/images/HouseAvatar.png' }}" alt="house"/>
</div>

@if(auth()->user()->id == $user->id)
    <h1>Mijn account</h1>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="house_pictures">House Pictures:</label>
        <input type="file" name="house_pictures" id="house_pictures">
    
        <button type="submit">Update House Pictures</button>
    </form>
@endif

@endsection

