<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $pets = Pet::all();

        return view('admin', compact('users', 'pets'));
    }

    public function block(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Admin users cannot be blocked.');
        }

        $user->update(['blocked' => true]);

        return redirect()->back()->with('status', 'User blocked successfully.');
    }

    public function denyClaim(Pet $pet)
    {
        $pet->update(['claim_status' => null]);

        return redirect()->back()->with('status', 'Claim denied successfully.');
    }
}
