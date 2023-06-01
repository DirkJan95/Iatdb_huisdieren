<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function index()
    {
        $users = User::all();

        return view('users', compact('users'));
    }

    public function getProfile($id)
    {
        $user = User::findOrFail($id);

        return view('profiel', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'house_pictures' => 'nullable|string',
        ]);

        $housePictures = $request->house_pictures;

        if (!empty($housePictures)) {
            $housePictures = 'http://127.0.0.1:8000/images/' . $housePictures;
        }

        $user->update([
            'house_pictures' => $housePictures,
        ]);

        return redirect()->back()->with('status', 'House pictures updated successfully.');
    }
}
