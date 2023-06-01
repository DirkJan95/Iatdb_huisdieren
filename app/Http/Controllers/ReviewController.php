<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($userId)
    {
        $user = User::findOrFail($userId);
        return view('reviews.create', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'review' => 'required|string',
        ]);

        $user = User::findOrFail($userId);

        $review = new Review([
            'review' => $request->input('review'),
            'reviewer_id' => $request->user()->id,
        ]);

        $user->reviews()->save($review);

        return redirect()->route('profile.show', ['id' => $userId])->with('status', 'Review added successfully.');
    }
}
