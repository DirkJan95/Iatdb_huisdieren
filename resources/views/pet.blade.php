@extends('layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">    
        <div class="petCard" style="width: 850px;">                           
            <img src="{{ $pet->pet_picture }}" alt="Pet Picture" style="width: 450px;">            
            <hr/>
            <div class="petCardContent">
                <div class="rightSide">
                    <h4>{{ $pet->name }}</h4>
                    <p>Breed: {{ $pet->breed }}</p>
                    <p>Date: {{ $pet->date }}</p>
                    <p>How Long: {{ $pet->how_long }}</p>
                    <p>Cost: ${{ $pet->cost }}</p>
                    <p>Age: {{ $pet->age }} years</p>
                    <p>{{ $pet->description }}</p>
                </div>
                <div class="leftSide">
                    <p>Breed: {{ $pet->breed }}</p>
                    <p>Date: {{ $pet->date }}</p>
                    <p>How Long: {{ $pet->how_long }}</p>
                    <p>Cost: ${{ $pet->cost }}</p>
                    <p>Age: {{ $pet->age }} years</p>                    
                    <p>{{ $pet->description }}</p>
                </div>
            </div>                   
        </div>        
    </div>
</div>

@endsection