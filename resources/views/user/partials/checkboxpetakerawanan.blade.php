<div>
    @foreach ($petakerawanans as $i => $petakerawanan)
        <div class="inline-block mt-2">
            {{-- tags --}}
            <div
                class=" {{ in_array($petakerawanan->id, $datapeta) ? 'hidden' : '' }} flex items-center w-fit border border-non-active rounded-lg px-3 py-2">
                <input type="checkbox" value="{{ $petakerawanan->id }}" multiple class="hidden" name="peta_kerawanan_id[]"
                    id="{{ $petakerawanan->id }}" onchange="Component.toggleActive(event)">
                <label class="select-none cursor-pointer text-[12px] min-w-max"
                    for="{{ $petakerawanan->id }}">{{ $petakerawanan->jenis }}</label>
            </div>
        </div>
    @endforeach
</div>
