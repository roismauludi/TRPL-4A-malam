<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnController extends Controller
{
    public function Turn()
    {
        return view('turnlamp');
    }
}
