<dialog id="modal_petakerawanan" class="modal">
    <div>
        <p class="text-[17px] font-bold">Tambahkan Peta Kerawanan</p>
        <form action="{{ isset($data) ? route('userpetakerawanan.update', $data->id) : ''}}" method="post">
            @method('patch')
            @csrf
            <div class="mt-5 flex sm:flex-row flex-row-reverse items-center gap-3" id="checkboxpeta">
               {{-- ajax --}}
            </div>
            <div class="mt-5">
                <div class="mb-3">
                    <p class="text-non-active">Kesimpulan terhadap siswa</p>
                </div>
                <textarea name="ket" class="input-form" rows="3">{{ $data->ket }}</textarea>
            </div>
            <div class="mt-5">
                <button class="btn-primary-form">Tambah</button>
                <button type="button" onclick="modal_petakerawanan.close()" class="btn-back-form">Back</button>
            </div>
        </form>
    </div>
</dialog>