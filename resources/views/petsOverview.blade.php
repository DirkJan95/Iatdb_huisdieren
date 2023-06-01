

@extends('layout')

@section('content')

<form action="{{ route('pet.index') }}" method="GET">
    <div class="form-group">
        <label for="breed">Breed:</label>
        <select name="breed" id="breed">
            <option value="">All</option>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
            <option value="Dog">Rabbit</option>            
        </select>
    </div>
    <div class="form-group">
        <label for="age">Age Range:</label>
        <select name="age" id="age">
            <option value="">All</option>
            <option value="0-1">0-1 year</option>
            <option value="1-3">1-3 years</option>            
        </select>
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
                    <form action="{{ route('pets.claim', ['pet' => $pet->id]) }}" method="POST">
                        @csrf
                        <button type="submit">Claim</button>
                    </form>
                @endif
                @if ($pet->claim_status === 'pending')
                    <h4>onder review</h4>
                @endif
            </div>
        @endif
    @endforeach
</div>



@endsection

