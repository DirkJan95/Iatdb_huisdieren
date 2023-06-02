@extends('layout')

@section('content')


<form class="filters alert alert-success" action="{{ route('pet.store') }}" method="POST">
    <h2>Voeg een huisdier toe:</h2>
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
        <label for="date">Welke datum?:</label>
        <input type="date" name="date" id="date" required>
    </div>
    <div>
        <label for="how_long">Hoelang oppassen?:</label>
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
        <textarea name="description" rows="5" placeholder="Voeg een beschrijving toe"></textarea>
    </div>
    <div>
        <button type="submit">Voeg toe!</button>
    </div>
</form>

<h1>Jouw huisdieren!</h1>
<div class="gridYourOwnPets"> 
    @foreach ($linkedPets as $pet)    
        @if(auth()->user()->id === $pet->ownerId)
            <div class="petCard">
                <img src="{{ $pet->pet_picture }}" alt="Pet"/>
                <div class="petCardTextContainer">
                    <h2>{{ $pet->name }}</h2>
                    <h4>Soort: {{ $pet->breed }}</h4>
                    <h4>Datum: {{ $pet->date }}</h4>  
                    @if($pet->claim_status == 'claimed')
                        <p>
                            <strong>Oppasser:</strong>
                            <a href="/profiel/{{ $pet->claimedUserId }}">{{ \App\Models\User::find($pet->claimedUserId)->name }}</a>  
                        </p>    
                    @endif
                    @if ($pet->claim_status === 'pending' && $pet->ownerId === auth()->id())                        
                        <p>
                            <strong>aanvraag door:</strong>
                            <a href="/profiel/{{ $pet->claimedUserId }}">{{ \App\Models\User::find($pet->claimedUserId)->name }}</a>  
                        </p>    
                        <form class="claimFormAcceptDeny" action="{{ route('pets.handleClaim', $pet->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="action" value="accept">Accepteren</button>
                            <button type="submit" name="action" value="deny">Afwijzen</button>
                        </form>                
                    @endif
                    @if ($pet->claim_status === 'claimed' && $pet->ownerId === auth()->id())
                        <form class="claimForm" action="{{ route('reviews.store', $pet->claimedUserId) }}" method="POST">
                            @csrf
                            <div>
                                <textarea name="review" rows="5" placeholder="Schrijf een review"></textarea>
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    @endif
                    </div>
            </div>
        @endif
    @endforeach
</div>

<h1>Oppas huisdieren!</h1>

<div class="gridYourClaimedPets"> 
    @foreach ($linkedPets as $pet)
        @if(auth()->user()->id === $pet->claimedUserId && $pet->claim_status === 'claimed')
            <div class="petCard">
                <img src="{{ $pet->pet_picture }}" alt="Pet"/>
                <div class="petCardTextContainer">
                    <h2>{{ $pet->name }}</h2>
                    <p>Soort: {{ $pet->breed }}</p>
                    <p>Datum: {{ $pet->date }}</p>  
                </div>      
            </div>
        @endif
    @endforeach
</div>
@endsection