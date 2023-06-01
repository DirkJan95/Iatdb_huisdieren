@extends('layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">    
        <div class="petCard" style="width: 850px;">                           
            <img src="{{ $pet->pet_picture }}" alt="Pet Picture" style="width: 450px;">            
            <hr/>
            <div class="petCardContent">
                <div class="leftSide">
                    <h4>{{ $pet->name }}</h4>
                    <p>Soort: {{ $pet->breed }}</p>
                    <p>Datum: {{ $pet->date }}</p>
                    <p>Hoe lang: {{ $pet->how_long }}</p>
                    <p>Kost per uur: ${{ $pet->cost }}</p>
                    <p>leeftijd: {{ $pet->age }} years</p>                    
                </div>
                <div class="rightSide">                                     
                    <p>{{ $pet->description }}</p>
                </div>
            </div>                   
        </div>        
    </div>
</div>

@endsection