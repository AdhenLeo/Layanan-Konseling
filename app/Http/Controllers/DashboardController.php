<?php

namespace App\Http\Controllers;

use App\Models\{
    Kelas,
    Log,
    Pertemuan,
    PetaKerawanan,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $users = User::whereNot('role', 'admin')->get();
        $petakerawanans = PetaKerawanan::all();
        $logs = Log::with('user')->paginate(5);

        $datas = getCountAndPertemuans();

        $countwaiting = $datas['countwaiting'];
        $countpending = $datas['countpending'];
        $countacc = $datas['countacc'];
        $pertemuans = $datas['pertemuans'];

        return view('dashboard', compact('kelas', 'users', 'logs', 'petakerawanans', 'pertemuans', 'countwaiting', 'countacc', 'countpending'));
    }
}
