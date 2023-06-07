@extends('layouts.mainLayout')

@section('title')
    {{ isset($data) ? 'Edit Pengguna' : 'Tambah Pengguna' }}
@endsection

@section('sub_title')
    {{ isset($data) ? 'Edit Pengguna' : 'Tambah Pengguna' }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/drag&drop.css') }}">
@endpush

@section('content')
<div class="my-7 mx-auto bg-white sm:w-3/4 w-4/5 rounded-2xl item h-fit p-5 shadow-md">
    <div>
        <p class="text-lg font-bold">{{ isset($data) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</p>
    </div>

    <form action="{{ isset($data) ? route('user.update', $data->id) : route('user.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @if (isset($data))
            @method('patch')
        @endif
        <div class="flex sm:flex-row flex-col  gap-4 ">
            {{-- left --}}
            <div class="mt-11 w-full">
                <div class="">
                    <p class="font-semibold text-base text-non-active mb-2">Nama</p>
                    <div class="flex sm:flex-row flex-col gap-2">
                        <input type="text" value="{{ isset($data) ? $data->nama : old('nama')}}" class="input-form" name="nama" required autocomplete="off">
                        <select name="jk" id="" class="input-select-sm sm:mt-0 mt-2">
                            <option value="" selected hidden>Jenis Kelamin</option>
                            @foreach ($jk as $jenis_kelamin)
                            <option value='{{  $jenis_kelamin }}' {{ isset($data) ? ($data->jk == $jenis_kelamin ? "selected" : "") : '' }}>{{ $jenis_kelamin }}</option>
                            @endforeach
                        </select>
                        <select name="role" id="role" class="input-select-sm">
                            <option value="" selected hidden>Pilih Role</option>
                            @foreach ($roles as $role)
                            <option value='{{  $role }}' {{ isset($data) ? ($data->role == $role ? "selected" : "") : '' }} class="capitalize">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Email</p>
                    <input type="email" value="{{ isset($data) ? $data->email : old('email')}}" class="input-form" name="email" required autocomplete="off">
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Kelas</p>
                    <select name="kelas_id[]" id="kelas_id" class="">
                        @foreach ($datas as $kelas)
                        <option value='{{  $kelas->id }}' {{ isset($data) ? ($data->kelas_id == $kelas->id ? "selected" : "") : '' }}>{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Password</p>
                    <input type="password" class="input-form" name="password" {{ isset($data) ? '' : 'required' }} autocomplete="off">
                </div>
            </div>
            {{-- right --}}
            <div class="sm:mt-11 mt-3 w-full">
                <div id="form-guru" hidden>
                    <div class="">
                        <p class="font-semibold text-base text-non-active mb-2">Visi</p>
                        <textarea class="input-form" name="visi" cols="40"></textarea>
                    </div>
                    <div class="mt-3">
                        <p class="font-semibold text-base text-non-active mb-2">Misi</p>
                        <textarea class="input-form" name="misi" cols="40"></textarea>
                    </div>
                    <div class="mt-3">
                        <p class="font-semibold text-base text-non-active mb-2">Bio</p>
                        <textarea class="input-form" name="biodata" cols="40"></textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Profile</p>
                    <div class="drag-area">
                        <div class="icon">
                            <i class="fa fa-files-o" aria-hidden="true"></i>
                        </div>
                        <div class="fileinfo">
                            <p></p>
                        </div>
                        <span class="header">Drag & Drop</span>
                        <span class="header">atau <span class="button">Cari</span></span>
                        <input type="file" name="profile" id="file-input" hidden>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="mt-7 flex gap-4">
            <button class="btn-primary-form">{{ isset($data) ? 'Ubah' : 'Buat' }}</button>
            <a href="{{ route('user.index') }}" class="btn-back-form">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('js')
    <script>
        new MultiSelectTag('kelas_id')  // id
    </script>
    <script src="{{ asset('assets/js/drag&drop.js') }}"></script>

    <script>
        $('#role').change(function (e) { 
            console.log($(this).val());
            $(this).val() == 'guru' ? $('#form-guru').removeAttr('hidden') : $('#form-guru').attr('hidden', 'true')
            
        });
    </script>
@endpush