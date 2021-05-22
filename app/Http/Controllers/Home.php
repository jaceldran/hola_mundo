<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoRequest;

class Home extends Controller
{
    public function index()
    {
        return view('home');
    }
}
