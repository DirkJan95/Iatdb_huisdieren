@extends('layout')

@section('content')

<div class="grid">
    @foreach($pets as $pet)
        <div class="petCard">               
            <img src="{{ $pet->pet_picture }}" alt="Pet" style="width:100%"/>
            <div class="petCardTextContainer">                 
                <h4>
                    <a href="pet/{{ $pet->id }}">
                    {{ $pet->name }}</a>
                </h4>
                <P>{{$pet->cost}} euro per uur</P>
            </div>
        </div>
    @endforeach
</div>

<form class="alert alert-success" action="{{ route('pet.store') }}" method="POST">
    @csrf
    <!-- Include form fields for your pet's attributes -->
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="breed">Breed:</label>
        <input type="text" name="breed" id="breed" required>
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
    </div>
    <div>
        <label for="how_long">How Long:</label>
        <input type="text" name="how_long" id="how_long" required>
    </div>
    <div>
        <label for="cost">Cost:</label>
        <input type="number" name="cost" id="cost" required>
    </div>
    <div>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required>
    </div>
    <div>
        <label for="pet_picture">Pet Picture:</label>
        <input type="file" name="pet_picture" id="pet_picture">
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>

@endsection

