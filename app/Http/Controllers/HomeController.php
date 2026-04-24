<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Hapus public function __construct() { ... }

    public function adminDashboard() {
        return view('admin.dashboard');
    }

    public function userDashboard() {
        return view('user.dashboard');
    }
}