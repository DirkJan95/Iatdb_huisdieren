@extends('layout')

@section('content')
<div class="grid"> 
@foreach ($pets as $pet)
@if ($pet->claim_status === 'pending')
    <div class="petCard">
        <div class="pet-info">
            <img src="{{ $pet->pet_picture }}" alt="Pet" />
            <div class="petCardTextContainer">
                <h2>{{ $pet->name }}</h2>                
                <p>Datum: {{ $pet->date }}</p>
                <a href="/profiel/{{ $pet->claimedUserId }}">{{ \App\Models\User::find($pet->claimedUserId)->name }}</a>     
                <form class="claimForm" action="{{ route('pets.denyClaim', ['pet' => $pet->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">Aanvraag annuleren</button>
                </form>
            </div>
        </div>
    </div>
    @endif
@endforeach
</div>

<h1>User List</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->role === 'admin')
                        N/A
                    @else
                        <form action="{{ route('users.block', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Block</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection