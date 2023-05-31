<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    /**
     * Get all pets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::all();

        return view('petsOVerview')->with('pets', $pets);
    }

    public function getPet($id)
    {
        $pet = Pet::findOrFail($id);

        return view('pet', compact('pet'));
    }

    /**
     * Create a new pet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'breed' => 'required|string',
            'date' => 'required|date',
            'how_long' => 'required|string',
            'cost' => 'required|integer',
            'age' => 'required|integer',
            'pet_picture' => 'nullable|string',
        ]);

        $data['ownerId'] = $request->user()->id;
        $user = $request->user();

        $user->pets()->create($data);

        return back()->with('status', "Huisdier toegevoegd!");
    }

    /**
     * Update a pet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        $data = $request->validate([
            'name' => 'string',
            'breed' => 'string',
            'date' => 'date',
            'how_long' => 'string',
            'cost' => 'integer',
            'age' => 'integer',
            'pet_picture' => 'nullable|string',
        ]);



        $pet->update($data);

        return response()->json($pet);
    }

    public function yourPets()
    {
        $user = auth()->user();
        $linkedPets = $user->pets;

        return view('jouwDieren')->with('linkedPets', $linkedPets);
    }

    public function claim(Request $request, Pet $pet)
    {
        $user = $request->user();
        $pet->update(['claimed' => true]);
        $user->pets()->attach($pet);


        return redirect()->back()->with('status', 'Pet claimed successfully.');
    }
}
