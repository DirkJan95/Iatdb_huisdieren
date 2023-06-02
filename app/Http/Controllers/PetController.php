<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Get all pets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pet::query();

        if ($request->filled('breed')) {
            $query->where('breed', $request->input('breed'));
        }

        if ($request->filled('cost')) {
            $costRange = explode('-', $request->input('cost'));
            $query->whereBetween('cost', $costRange);
        }

        if ($request->filled('date')) {
            $query->where('date', $request->input('date'));
        }

        $pets = $query->get();

        return view('petsOverview', compact('pets'));
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
            'description' => 'nullable|string',
        ]);

        if ($request->has('pet_picture')) {
            $data['pet_picture'] = 'http://127.0.0.1:8000/images/' . $request->input('pet_picture');
        }

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
        $pet->update(['claim_status' => 'pending', 'claimedUserId' => $request->user()->id]);
        $user->pets()->attach($pet);


        return redirect()->back()->with('status', 'Pet claimed successfully.');
    }

    public function handleClaim(Request $request, Pet $pet)
    {
        $action = $request->input('action');

        $user = $request->user();

        if ($user->id !== $pet->ownerId) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        if ($action === 'accept') {
            $pet->update(['claim_status' => 'claimed']);
            return redirect()->back()->with('status', 'Pet claim accepted.');
        } elseif ($action === 'deny') {
            $pet->update(['claimedUserId' => null, 'claim_status' => null]);
            return redirect()->back()->with('status', 'Pet claim denied.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }
}
