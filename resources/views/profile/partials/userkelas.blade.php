@foreach ($datas as $kelas)
    <div class="inline-block mt-2">
        <div class="flex items-center w-fit bg-secondary gap-2 rounded-lg px-3 py-1">
            <div class="overflow-auto">
                <p class="text-[12px] min-w-max">{{ $kelas->kelas->nama }}</p>
            </div>
            <div class="flex items-center border-non-active border-l pl-2">
                <span class="material-symbols-outlined cursor-pointer"
                    onclick="Component.deleteKelasGuru({route: '{{ route('userkelas.destroy', ['iduser' => Auth::user()->id,'idkelas' => $kelas->kelas->id]) }}', token: '{{ csrf_token() }}', routeshow: '{{ route('userkelas.show', Auth::user()->id) }}' })">cancel</span>
            </div>
        </div>
    </div>
@endforeach
