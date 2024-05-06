<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard.index", [
            "title" => "Dashboard",
            "count_post" => User::find(auth()->user()->id)->blog()->count()
        ]);
    }
}

