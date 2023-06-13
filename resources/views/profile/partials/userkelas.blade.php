@foreach ($data->kelas as $kelas)
    @if (Auth::user()->role != 'guru')
        <div class="inline-block mt-2">
            <div class="flex items-center w-fit bg-secondary rounded-lg px-3 py-2">
                <p class="text-[12px] min-w-max">{{ $kelas->nama }}</p>
            </div>
        </div>
    @else
        <div class="inline-block mt-2">
            <div class="flex items-center w-fit bg-secondary gap-2 rounded-lg px-3 py-1">
                <div class="overflow-auto">
                    <p class="text-[12px] min-w-max">{{ $kelas->nama }}</p>
                </div>
                <div class="flex items-center border-non-active border-l pl-2">
                    <span class="material-symbols-outlined cursor-pointer"
                        onclick="Component.deleteKelasGuru({route: '{{ route('userkelas.destroy', $data->id) }}', token: '{{ csrf_token() }}', routeshow: '{{ route('userkelas.show', Auth::user()->id) }}'})">cancel</span>
                </div>
            </div>
        </div>
    @endif
@endforeach
