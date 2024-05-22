<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        /*
        User::create([
            'name' => 'John',
            'email' => 'john@doe.fr',
            'password' => Hash::make('0000')
        ]);
        */
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return to_route('login')->with('success', 'Vous êtes maintenant déconnecté');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended(route('admin.property.index'));
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects'
        ])->onlyInput('email');
    }
}
