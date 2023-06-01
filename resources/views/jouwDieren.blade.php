@extends('layout')

@section('content')

<h1>Voeg een huisdier toe:</h1>

<form class="alert alert-success" action="{{ route('pet.store') }}" method="POST">
    @csrf    
    <div>
        <label for="name">Naam:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="breed">Soort dier:</label>
        <input type="text" name="breed" id="breed" required>
    </div>
    <div>
        <label for="date">Welke datum moet er opgepast worden?:</label>
        <input type="date" name="date" id="date" required>
    </div>
    <div>
        <label for="how_long">Hoelang moet er opgepast worden?:</label>
        <input type="text" name="how_long" id="how_long" required>
    </div>
    <div>
        <label for="cost">Kosten per uur:</label>
        <input type="number" name="cost" id="cost" required>
    </div>
    <div>
        <label for="age">Leeftijd:</label>
        <input type="number" name="age" id="age" required>
    </div>
    <div>
        <label for="pet_picture">Foto:</label>
        <input type="file" name="pet_picture" id="pet_picture">
    </div>
    <div>
        <button type="submit">Voeg toe!</button>
    </div>
</form>

<h1>Jouw huisdieren!</h1>
@foreach ($linkedPets as $pet)    
    @if(!auth()->user()->id != $pet->ownerId)
        <div>
            <h2>{{ $pet->name }}</h2>
            <img src="{{ $pet->pet_picture }}" alt="Pet" style="width:20%"/>
            <p>Breed: {{ $pet->breed }}</p>
            <p>Date: {{ $pet->date }}</p>  
            @if($pet->claim_status == 'claimed')
                <a href="/profiel/{{ $pet->claimedUserId }}">oppasser</a>      
            @endif
            @if ($pet->claim_status === 'pending' && $pet->ownerId === auth()->id())
                <h4>aanvraag door:</h4>
                <a href="/profiel/{{ $pet->claimedUserId }}">oppasser</a>    
                <form action="{{ route('pets.handleClaim', $pet->id) }}" method="POST">
                    @csrf
                    <button type="submit" name="action" value="accept">Accept</button>
                    <button type="submit" name="action" value="deny">Deny</button>
                </form>
                <form action="{{ route('reviews.store', $pet->claimedUserId) }}" method="POST">
                    @csrf
                    <div>
                        <textarea name="review" rows="5" placeholder="Write your review"></textarea>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            @endif
        </div>
    @endif
@endforeach



<h1>Oppas huisdieren!</h1>
@foreach ($linkedPets as $pet)
    @if(auth()->user()->id != $pet->ownerId)
        <div>
            <h2>{{ $pet->name }}</h2>
            <p>Breed: {{ $pet->breed }}</p>
            <p>Date: {{ $pet->date }}</p>        
        </div>
    @endif
@endforeach

@endsection