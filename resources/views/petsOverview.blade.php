

@extends('layout')

@section('content')
    
<div class="grid">
    @foreach($pets as $pet)

    {{-- @php
        // Dump a variable to the console in a Blade view
        dd(!auth()->user()->id != $pet->ownerId);
    @endphp
    --}}

        @if(auth()->user()->id != $pet->ownerId && !$pet->claimed)
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
                <form action="{{ route('pets.claim', ['pet' => $pet->id]) }}" method="POST">
                    @csrf
                    <button type="submit">Claim</button>
                </form>
            </div>
        @endif
    @endforeach
</div>



@endsection

