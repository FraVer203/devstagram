<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // Metodo store
    public function store(User $user){
        // dd($user->username);
        $user->followers()->attach( auth()->user()->id );

        return back();
    }
    // Metodo destroy
    public function destroy(User $user){
        $user->followers()->detach( auth()->user()->id );

        return back();
    }
}
