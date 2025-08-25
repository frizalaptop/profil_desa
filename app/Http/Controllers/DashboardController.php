<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;

class DashboardController extends Controller
{
    // Di DashboardController atau HomeController
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $pendingUmkms = Umkm::where('verified', false)->get();
            $users = User::where('id', '!=', auth()->id())
                ->where('email_verified_at', '!=', null)
                ->get();
            
            return view('dashboard', compact('pendingUmkms', 'users'));
        }
        
        return view('dashboard');
    }
}
