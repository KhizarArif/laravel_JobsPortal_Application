<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth.register");
    }

    public function create(RegisterAccount $request)
    {
        $first_name = $request->input("first_name");
        $last_name = $request->input("last_name");
        $info = array(
            "name" => $first_name . ' ' . $last_name,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        );

        $user = User::create($info);
        if ($user and $user->id > 0)
            return redirect(route('login'))->with('message', 'Account created Successfully!');
        else
            return redirect()->back()->with('error', 'Something happen Wrong. Please Try again. ');
    }
}
