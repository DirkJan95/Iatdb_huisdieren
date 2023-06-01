@extends('layout')

@section('content')

@foreach ($pets as $pet)
    @if ($pet->claim_status === 'pending')
        <div class="pet-info">
            <h2>{{ $pet->name }}</h2>
            <img src="{{ $pet->pet_picture }}" alt="Pet" style="width:20%"/>
            <p>Breed: {{ $pet->breed }}</p>
            <p>Date: {{ $pet->date }}</p>  

            <form action="{{ route('pets.denyClaim', ['pet' => $pet->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit">Deny Claim</button>
            </form>
        </div>
    @endif
@endforeach

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