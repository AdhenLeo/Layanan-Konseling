<dialog id="modal_kelas_guru" class="modal">
    <div>
        <p class="text-[17px] font-bold">Tambahkan Kelas Anda</p>
        <form action="{{ route('profile.addKelas') }}" method="post">
            @csrf
            <div class="mt-5" id="inputkelas">
                <select name="kelas_id[]" required multiple id="kelas_id">
                    @foreach ($datas as $data)
                    @if (!in_array($data->id, $idkelas))
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mt-16">
                <button class="btn-primary-form">Tambah</button>
                <button type="button" onclick="modal_kelas_guru.close()" class="btn-back-form">Back</button>
            </div>
        </form>
    </div>
</dialog>