<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view("register.index", [
            "active" => "register",
            "title" => "register"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "username" => ["required", "min:8", "max:100", "unique:users"] ,
            "name" => ["required", "max:100"],
            "email" => ["required", "unique:users", "email:dns"],
            "password" =>["required", "min:8", "max:255"]
        ]);

        // $validatedData["password"] = bcrypt($validatedData["password"]);
        $validatedData["password"] = Hash::make($validatedData["password"]);


        User::create($validatedData);

        return redirect("/login")->with("success", "registrasi berhasil");
    }
}
