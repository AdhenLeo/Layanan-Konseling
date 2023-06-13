@extends('layouts.mainLayout')

@section('title')
    Edit User
@endsection

@section('sub_title')
    Edit User
@endsection

@section('modal')
    @include('partials.modals.modalpetakerawanan')
@endsection

@section('content')
<div class="w-11/12 my-10 flex sm:flex-row flex-col gap-8 mx-auto">
    {{-- left --}}
    <div class="rounded-xl sm:w-5/6 w-full bg-white p-5">
        <div class="p-3">
            <p class="font-semibold text-[20px]">Update User</p>
        </div>
        <div class="mx-auto px-4 mt-3 border-t border-non-active flex sm:flex-row flex-col items-center sm:gap-8 gap-2">
            <div class="w-[100px] h-[100px] mt-8 bg-non-active rounded-full overflow-clip">
                <img src="{{ $data->profile != 'img/profile.png' ? asset('storage/'. $data->profile) : asset($data->profile) }}" class="w-[100px] h-[100px]" alt="">
            </div>
            <div class="mt-10 text-left flex flex-col gap-3">
                <div class="flex items-center gap-10">
                    <p class="font-bold text-[20px] leading-7 min-w-20">{{ $data->nama }}</p>
                    <span class="material-symbols-outlined hidden">more_horiz</span>
                </div>
                <p class="font-base leading-3 text-non-active">{{ $data->role }}</p>
            </div>
            <div>
            </div>
        </div>
        <div class="w-11/12 mt-10 mx-auto border-t border-non-active flex">
            <div class="w-11/12 mt-4 mx-auto">
                <div>
                    {{-- kelas --}}
                    <p class="text-[13px] font-semibold">Kelas</p>
                    <div class="mt-2 gap-4">
                        <div class="inline-block mt-2">
                            {{-- tags --}}
                            <div class="flex items-center w-fit bg-secondary rounded-lg px-3 py-2">
                                <p class="text-[12px] min-w-max">
                                    @foreach ($data->kelas as $kelas)
                                        {{ $kelas->nama }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                {{-- petakerawanan --}}
                <div class="mt-5">
                    <p class="text-[13px] font-semibold">Peta Kerawanan</p>
                    <div class="mt-2 gap-4" id="result-tags">
                        {{-- ajax --}}
                    </div>
                </div>
                <div class="mt-5 flex">
                    <button class="p-2 bg-primary flex items-center text-white rounded-full" onclick="modal_petakerawanan.showModal()"><span class="material-symbols-outlined">add_circle</span></button>
                </div>
            </div>
        </div>
    </div>
    {{-- right --}}
    <div class="rounded-xl h-fit w-full bg-white p-5">
        <div class="p-3">
            <p class="font-semibold text-[20px]">Display Information</p>
        </div>
        <div class="mx-auto px-4 mt-3 border-t border-non-active flex flex-col gap-8">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex sm:flex-row flex-col w-full mx-auto mt-16 gap-6">
                    <div class="w-full">
                        <div class="">
                            <p class="mb-2 font-semibold">Nama</p>
                            <input type="text" name="nama" {{ isset($data) ? 'disabled':'' }} value="{{ $data->nama }}" required class="input-form">
                        </div>
                        <div class="mt-5">
                            <p class="mb-2 font-semibold">Email</p>
                            <input type="email" name="email" {{ isset($data) ? 'disabled':'' }} value="{{ $data->email }}" required class="input-form">
                        </div>
                        <div class="mt-5">
                            <p class="mb-2 font-semibold">Password</p>
                            <input type="password" name="password" {{ isset($data) ? 'disabled':'' }} class="input-form">
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="w-full h-full border-dashed border-2 border-non-active p-3 flex flex-col items-center justify-center">
                            <div class="w-24 h-24 mx-auto bg-non-active overflow-clip rounded-full flex items-center justify-center ">
                                <div id="result" class="cover"></div>
                            </div>
                            <label for="profile">
                                <p class="py-2 w-28 mx-auto mt-8 bg-primary text-xs text-center text-white rounded-md cursor-pointer">Change Photo</p>
                            </label>
                            <input type="file" {{ isset($data) ? 'disabled':'' }} accept="image/*" onchange="Component.liveImage(this)" hidden name="profile" id="profile">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection

@push('js')
    <script>
        Component.showPetaKerawanan({route: "{{ route('userpetakerawanan.show', $data->id) }}", token: "{{ csrf_token() }}"})
    </script>
@endpush