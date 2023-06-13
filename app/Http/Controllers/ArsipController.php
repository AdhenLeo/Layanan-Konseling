<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $datas = Pertemuan::with('user', 'guru')->where('status', 'done')->paginate(5);
        }elseif(Auth::user()->role == 'walas'){
            $siswas = getSiswaGuru();
            $datas = Pertemuan::with('user', 'guru')->whereIn('user_id', $siswas)->where('status', 'done')->paginate(5);
        }elseif(Auth::user()->role == 'guru' ){
            $datas = Pertemuan::with('user', 'guru')->where('guru_id', Auth::user()->id)->where('status', 'done')->paginate(5);
        }elseif(Auth::user()->role == 'user'){
            $datas = Pertemuan::with('user', 'guru')->where('user_id', Auth::user()->id)->where('status', 'done')->paginate(5);
        }
        return view('arsip.index', compact('datas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
