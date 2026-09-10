<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackDashboardController extends Controller
{
    public function index(){
        return view('backend.back-dashboard');
    }

    public function sessionExpired(){
        return view('session_expired');
    }

    public function pageNotFound(){
        return view('pages_not_found');
    }
    
    public function underconstration(){
        return view('underconstration');
    }
}
