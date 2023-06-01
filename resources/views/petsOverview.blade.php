@extends('layout')

@section('content')

<form class="filters" action="{{ route('pet.index') }}" method="GET">
    <div class="form-group">
        <label for="breed">Soort dier:</label>
        <select name="breed" id="breed">
            <option value="">Alles</option>
            <option value="Cat">Kat</option>
            <option value="Dog">Hond</option>
            <option value="Other">Anders</option>            
        </select>
    </div>
    <div class="form-group">
        <label for="cost">Kosten is euro's:</label>
        <select name="cost" id="cost">
            <option value="">Alles</option>
            <option value="0-5">0 - 5</option>
            <option value="5-10">5 - 10</option>
            <option value="10-20">10 - 20</option>     
            <option value="21-9999">20+</option>         
        </select>
    </div> 
    <div class="form-group">
        <label for="date">Start datum:</label>
        <input type="date" name="date" id="date">
    </div>  
       
    <button type="submit">Filter</button>
</form>
    
<div class="grid">
    @foreach($pets as $pet)   

        @if(auth()->user()->id != $pet->ownerId && $pet->claim_status != 'claimed')
            <div class="petCard">               
                <img src="{{ $pet->pet_picture }}" alt="Pet" style="width:100%"/>
                <div class="petCardTextContainer">                 
                    <h4>
                        <a href="pet/{{ $pet->id }}">
                        {{ $pet->name }}</a>
                    </h4>
                    <h4>{{$pet->cost}} euro per uur</h4>

                    <h4>op {{$pet->date}}</h4>
                </div>
                @if ($pet->claim_status == null)
                    <form class="claimForm" action="{{ route('pets.claim', ['pet' => $pet->id]) }}" method="POST">
                        @csrf
                        <button type="submit">Vraag om op te passen!</button>
                    </form>
                @endif
                @if ($pet->claim_status === 'pending')
                    <h2 class="claimed">onder aanvraag!</h2>
                @endif
            </div>
        @endif
    @endforeach
</div>



@endsection

