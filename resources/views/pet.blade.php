@extends('layout')

@section('content')

<div class="petContainer">
    <div class="row">    
        <div class="petCardOne" >                           
            <img src="{{ $pet->pet_picture }}" alt="Pet Picture">            
            <hr/>
            <div class="petCardContent">
                <div class="leftSide">
                    <h4>{{ $pet->name }}</h4>
                    <p>Soort: {{ $pet->breed }}</p>
                    <p>Datum: {{ $pet->date }}</p>
                    <p>Hoe lang: {{ $pet->how_long }}</p>
                    <p>Kost per uur: ${{ $pet->cost }}</p>
                    <p>leeftijd: {{ $pet->age }} jaar</p>                    
                </div>
                <div class="rightSide">                                     
                    <p>{{ $pet->description }}</p>
                </div>
            </div>                   
        </div>        
    </div>
</div>

@endsection