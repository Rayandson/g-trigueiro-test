<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SigninController extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|max:255",
            "password" => "required",
        ]);

        if(!auth()->attempt($request->only("email", "password"), $request->remember)) {
            return back()->with("status", "Email ou senha incorretos");
        }

        return redirect()->route("home");
    }
}
