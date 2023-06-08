@extends('layouts.mainLayout')

@section('title')
    {{ isset($data) ? 'Edit Peta Kerawanan' : 'Tambah Peta Kerawanan' }}
@endsection

@section('sub_title')
    {{ isset($data) ? 'Edit Peta Kerawanan' : 'Tambah Peta Kerawanan' }}
@endsection

@section('content')
<div class="my-12 mx-auto bg-white sm:w-3/4 w-4/5 rounded-2xl item h-fit p-5 shadow-md">
    <div>
        <p class="text-lg font-bold">{{ isset($data) ? 'Edit Peta Kerawanan' : 'Tambah Peta Kerawanan' }}</p>
    </div>

    <form action="{{ isset($data) ? route('petakerawanan.update', $data->id) : route('petakerawanan.store') }}" method="POST">
        @csrf
        @if (isset($data))
            @method('patch')
        @endif
        <div class="mt-11">
            <p class="font-semibold text-base text-non-active mb-2">Jenis Peta Kerawanan</p>
            <input type="text" value="{{ isset($data) ? $data->jenis : old('jenis')}}" class="input-form @error('jenis') input-error @enderror" name="jenis" required autocomplete="off">
            @error('jenis')
            <small class="text-danger font-semibold">{{ $messages }}</small>
            @enderror
        </div>
    
        <div class="mt-7 flex gap-4">
            <button class="btn-primary-form">{{ isset($data) ? 'Ubah' : 'Buat' }}</button>
            <a href="{{ route('petakerawanan.index') }}" class="btn-back-form">Batal</a>
        </div>
    </form>
</div>
@endsection