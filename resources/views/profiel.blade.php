@extends('layout')

@section('content')

<div class="profile-container">
    <div class="profile-info">
        <p><strong>Naam:</strong> {{ $user->name }}</p>            
    </div>
    <div class="reviews">
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
            <p>Nog geen reviews!</p>
    @endif
    </div>
    <img src="{{ $user->house_pictures ? $user->house_pictures : 'http://127.0.0.1:8000/images/HouseAvatar.png' }}" alt="house"/>
</div>

@if(auth()->user()->id == $user->id)
    <h1>Mijn account instellingen</h1>
    <form class="filters uploadProfilePicture" action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="house_pictures">Upload een foto van je huis:</label>
        <input type="file" name="house_pictures" id="house_pictures">
    
        <button type="submit">Upload!</button>
    </form>
@endif

@endsection

