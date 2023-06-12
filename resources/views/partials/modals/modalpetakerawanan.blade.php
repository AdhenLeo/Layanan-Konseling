<dialog id="modal_petakerawanan" class="modal">
    <div>
        <p class="text-[17px] font-bold">Tambahkan Peta Kerawanan</p>
        <form action="{{ route('profile.update', 1) }}" method="post">
            @method('patch')
            @csrf
            <div class="mt-5 flex sm:flex-row flex-row-reverse items-center gap-3">
               <div>
                @foreach ($petakerawanans as $i => $data)
                
                    <div class="inline-block mt-2">
                        {{-- tags --}}
                        <div class=" {{ in_array($data->id, $datapeta) ? 'hidden' : '' }} flex items-center w-fit border border-non-active rounded-lg px-3 py-2">
                            <input type="checkbox" value="{{ $data->id }}" multiple class="hidden" name="peta_kerawanan_id[]" id="{{ $data->id }}" onchange="Component.toggleActive(event)">
                            <label class="select-none cursor-pointer text-[12px] min-w-max" for="{{ $data->id }}">{{ $data->jenis }}</label>
                        </div>
                    </div>
                @endforeach
               </div>
            </div>
            <div class="mt-5">
                <button class="btn-primary-form">Tambah</button>
                <button type="button" onclick="modal_petakerawanan.close()" class="btn-back-form">Back</button>
            </div>
        </form>
    </div>
</dialog>