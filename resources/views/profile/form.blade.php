@extends('layouts.mainLayout')

@section('title')
    Edit Profile - DeepTalk
@endsection

@section('sub_title')
    Edit Profile
@endsection


@section('content')
<div class="w-11/12 my-10 flex sm:flex-row flex-col gap-8 mx-auto">
    {{-- left --}}
    <div class="rounded-xl sm:w-5/6 w-full h-fit bg-white p-5">
        <div class="p-3">
            <p class="font-semibold text-[20px]">Update Profile</p>
        </div>
        <div class="mx-auto px-4 mt-3 border-t border-non-active flex sm:flex-row flex-col items-center sm:gap-8 gap-2">
            <div class="w-[100px] h-[100px] mt-8 bg-non-active rounded-full overflow-clip">
                <img src="{{ Auth::user()->profile != 'img/profile.png' ? asset('storage/'. Auth::user()->profile) : asset(Auth::user()->profile) }}" alt="">
            </div>
            <div class="mt-10 text-left flex flex-col gap-3">
                <div class="flex items-center gap-10">
                    <p class="font-bold text-[20px] leading-7 min-w-20">{{ Auth::user()->nama }}</p>
                    <span class="material-symbols-outlined hidden">more_horiz</span>
                </div>
                <p class="font-base leading-3 text-non-active">{{ Auth::user()->role }}</p>
            </div>
            <div>
            </div>
        </div>
        @if (Auth::user()->role != 'admin')
            {{-- detail --}}
            <div class="w-11/12 mt-10 mx-auto border-t border-non-active flex">
                <div class="w-11/12 mt-4 mx-auto">
                    <div>
                        {{-- kelas --}}
                        <p class="text-[13px] font-semibold">Kelas</p>
                        <div class="mt-2 gap-4" id="result-tags">
                            {{-- ajax --}}
                            @if (Auth::user()->role != 'guru')
                                @foreach ($data->kelas as $kelas)
                                <div class="inline-block mt-2">
                                    <div class="flex items-center w-fit bg-secondary rounded-lg px-3 py-2">
                                        <p class="text-[12px] min-w-max">{{ $kelas->nama }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- right --}}
    <div class="rounded-xl h-fit w-full bg-white p-5">
        <div class="p-3">
            <p class="font-semibold text-[20px]">Display Information</p>
        </div>
        <div class="mx-auto px-4 mt-3 border-t border-non-active flex flex-col gap-8">
            <form action="{{ route('profile.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="flex sm:flex-row flex-col w-full mx-auto mt-16 gap-6">
                    <div class="w-full">
                        <div class="">
                            <p class="mb-2 font-semibold">Nama</p>
                            <input type="text" name="nama" value="{{ Auth::user()->nama }}" required class="input-form">
                        </div>
                        <div class="mt-5">
                            <p class="mb-2 font-semibold">Email</p>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" required class="input-form">
                        </div>
                        <div class="mt-5">
                            <p class="mb-2 font-semibold">Password</p>
                            <input type="password" name="password" class="input-form">
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
                            <input type="file" accept="image/*" onchange="Component.liveImage(this)" hidden name="profile" id="profile">
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <button class="btn-primary-form">Simpan</button>
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection

@if (Auth::user()->role == 'guru')
@section('js')
    <script>
        Component.showKelasGuru({route: "{{ route('userkelas.show', Auth::user()->id) }}"})
    </script>
@endsection
@endif