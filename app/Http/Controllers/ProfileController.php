<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', ['user' => $user]);
    }
}
