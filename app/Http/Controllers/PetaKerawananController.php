<?php

namespace App\Http\Controllers;

use App\Http\Requests\petakerawanan\{
    PostPetaKerawananRequest,
    UpdatePetaKerawananRequest
};
use App\Models\PetaKerawanan;
use Illuminate\Http\Request;

class PetaKerawananController extends Controller
{
    public function index()
    {
        dd("ok");
        $datas = PetaKerawanan::paginate(4);
        return view('petakerawanan.index', compact('datas'));
    }

    public function create()
    {
        return view('petakerawanan.form');
    }

    public function store(PostPetaKerawananRequest $request)
    {
        try {

            $data = [
                'jenis' => $request->jenis
            ];
            
            PetaKerawanan::create($data);
            dd($request->all());

            return redirect()->route('petakerawanan.index')->with('msg_success', 'Berhasil membuat peta kerawanan');
        } catch (\Throwable $th) {
            return redirect()->route('petakerawanan.index')->with('msg_error', 'Berhasil membuat peta kerawanan');
        }
    }

    public function show(PetaKerawanan $petaKerawanan)
    {
        return view('petakerawanan.show');
    }

    public function edit(PetaKerawanan $petaKerawanan)
    {
        $data = $petaKerawanan;
        return view('petakerawanan.form', compact('data'));
    }

    public function update(UpdatePetaKerawananRequest $request, $id)
    {
        try {
            $petaKerawanan = PetaKerawanan::find($id);
            $data = [
                'jenis' => $request->jenis
            ];

            $petaKerawanan->update($data);

            return redirect()->route('petakerawanan.index')->with('msg_success', 'Berhasil mengubah peta kerawanan');
        } catch (\Throwable $th) {
            return redirect()->route('petakerawanan.index')->with('msg_error', 'Berhasil mengubah peta kerawanan');
        }
    }

    public function destroy(PetaKerawanan $petaKerawanan)
    {
        if(!$petaKerawanan) return abort(404);

        $petaKerawanan->delete();

        return redirect()->route('petakerawanan.index')->with('msg_success', 'Berhasil menghapus peta kerawanan');
    }
}
