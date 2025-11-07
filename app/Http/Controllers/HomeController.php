<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //use Illuminate\Support\Facades\Auth;
        $user = Auth::user();

        if ($user->hasRole('alumno')) {
            $alumno = $user->alumno; // accede a la relación
            return view('home', compact('alumno'));
        }

        return view('home');
    }
}
