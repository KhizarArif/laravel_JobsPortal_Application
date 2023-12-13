<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = request('remember', 0);
        $credentials = array(
            "email" => $email,
            "password" => $password,
            "role" => User::ADMIN_ROLE
        );

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
