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
        switch (Auth::user()->role()->name) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'School':
                return redirect()->route('school.dashboard');
            case 'Student':
                return view('student.dashboard');
        }
    }
}
