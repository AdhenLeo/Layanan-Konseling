<?php

namespace App\Http\Controllers;

use App\Models\{
    Kelas,
    Log,
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
        $logs = Log::with('user')->paginate(5);
        return view('dashboard', compact('kelas', 'users', 'logs'));
    }
}
