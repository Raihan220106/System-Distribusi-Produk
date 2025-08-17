<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthManualController extends Controller
{
    public function index()
    {
        return view('manual-auth.login');
    }

   public function loginProses(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        Auth::login($user); // <- pakai Auth bawaan Laravel
        return redirect()->route('distributions.index');
    }

    return back()->withErrors(['email' => 'Email atau password salah']);
}


    public function logout(Request $request)
    {
        //

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
