<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function index()
    {
        $users = DB::table('users')->select('id', 'name')->get();

        return view('some-view')->with('users', $users);
    }
}
