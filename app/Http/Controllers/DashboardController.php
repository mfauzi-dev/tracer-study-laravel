<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
       $user = auth()->user();


        if (!$user) {
            abort(403);
        }

        if ($user->role_as === 'admin') {
            return view('pages.dashboard.admin');
        }

        if ($user->role_as === 'alumni') {
            return view('pages.dashboard.alumni');
        }

        abort(403);
    }
}
