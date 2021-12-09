<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $torrents = $user->uploads()->paginate(10);
        return view('users.show', compact('user', 'torrents'));
    }
}
