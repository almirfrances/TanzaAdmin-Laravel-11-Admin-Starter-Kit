<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index() {
        $title = 'User Dashboard';
        $user = auth()->user();
        return view('user.dashboard.index', compact('title', 'user'));
    }

}