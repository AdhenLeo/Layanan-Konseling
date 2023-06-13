<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {
        $datas = Pertemuan::with('siswa', 'guru')->get();
        return view('arsip.index');
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
