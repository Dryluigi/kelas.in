<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        $isLoggedIn = auth()->attempt($request->only('email', 'password'), $request->remember);

        if(!$isLoggedIn) {
            return back()->with('status', 'Login gagal, periksa kembali email dan password anda.');
        }

        return redirect()->route('profile.classes');
    }
}
