@extends('layouts.mainLayout')

@section('title')
    {{ isset($data) ? 'Edit Kelas' : 'Tambah Kelas' }}
@endsection

@section('sub_title')
    {{ isset($data) ? 'Edit Kelas' : 'Tambah Kelas' }}
@endsection

@section('content')
<div class="my-12 mx-auto bg-white sm:w-11/12
 w-4/5 rounded-2xl item h-fit p-5 shadow-md">
    <div>
        <p class="text-lg font-bold">{{ isset($data) ? 'Edit Kelas' : 'Tambah Kelas' }}</p>
    </div>

    <form action="{{ isset($data) ? route('kelas.update', $data->id) : route('kelas.store') }}" method="POST">
        @csrf
        @if (isset($data))
            @method('patch')
        @endif
        <div class="mt-11">
            <p class="font-semibold text-base text-non-active mb-2">Nama Kelas</p>
            <input type="text" value="{{ isset($data) ? $data->nama : old('nama')}}" class="input-form @error('nama') input-error @enderror" name="nama" required autocomplete="off">
            @error('nama')
            <small class="text-danger font-semibold">{{ $messages }}</small>
            @enderror
        </div>
    
        <div class="mt-7 flex sm:flex-row flex-row-reverse gap-4">
            <button class="btn-primary-form">{{ isset($data) ? 'Ubah' : 'Buat' }}</button>
            <a href="{{ route('kelas.index') }}" class="btn-back-form">Batal</a>
        </div>
    </form>
</div>
@endsection