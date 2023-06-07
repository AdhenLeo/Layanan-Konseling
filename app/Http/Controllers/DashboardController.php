<?php

namespace App\Http\Controllers;

use App\Models\{
    Kelas,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $users = User::all();
        return view('dashboard', compact('kelas', 'users'));
    }
}
