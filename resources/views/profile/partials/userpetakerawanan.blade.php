{{-- tags --}}
@foreach ($datas as $data)
    <div class="inline-block mt-2">
        <div class="flex items-center w-fit bg-secondary gap-2 rounded-lg px-3 py-1">
            <div class="overflow-auto">
                <p class="text-[12px] min-w-max">{{ $data->peta_kerawanan->jenis }}</p>
            </div>
            <div class="flex items-center border-non-active border-l pl-2">
                <span class="material-symbols-outlined cursor-pointer" onclick="Component.deletePetaKerawanan({route: '{{ route('profile.destroy', $data->id) }}', token: '{{ csrf_token() }}', routeshow: '{{ route('profile.show', 1) }}'})">cancel</span>
            </div>
        </div>
    </div>
@endforeach