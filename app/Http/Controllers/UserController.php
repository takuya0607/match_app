<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; //この行を追記

class UserController extends Controller
{
    //
    public function show($id)
    {
        $user = User::findOrFail($id); // 追記

        return view('users.show', compact('user'));
    }
}
