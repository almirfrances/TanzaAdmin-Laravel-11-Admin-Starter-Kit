<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {

        $totalMessages = Message::count();


        $title = 'Dashboard';

        if (Auth::guard('admin')->check()) {
            return view('admin.dashboard.index', compact('title', 'totalMessages'
        )); 
        } else {
            return redirect()->route('admin.login');
        }
    }
}