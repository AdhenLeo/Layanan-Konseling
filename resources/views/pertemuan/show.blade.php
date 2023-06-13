@extends('layouts.mainLayout')

@section('title')
    Pertemuan
@endsection

@section('sub_title')
    Pertemuan
@endsection

@section('modal')
@include('partials.modals.modalreject')
@endsection

@section('content')
<div class="p-5 my-12 rounded-xl bg-white shadow-card sm:w-11/12 w-4/5 mx-auto">
    {{-- status --}}
    <div class="sm:w-4/5 w-full sm:flex-row flex-col flex mx-auto sm:gap-0 gap-4 items-center sm:justify-evenly justify-start font-semibold">
        <div class="flex items-center sm:flex-row flex-col gap-3">
            <div class="{{ $data->status == "waiting" ? 'status-active' : 'status-non-active' }}">
                <p>1</p>
            </div>
            <p class="text-[19px]">Waiting</p>
        </div>
        <div class="flex items-center sm:flex-row flex-col gap-3">
            <div class="{{ $data->status == "pending" ? 'status-active' : 'status-non-active' }}">
                <p>2</p>
            </div>
            <p class="text-[19px]">Pending</p>
        </div>
        <div class="flex items-center sm:flex-row flex-col gap-3">
            <div class="{{ $data->status == "accept" ? 'status-active' : 'status-non-active' }}">
                <p>3</p>
            </div>
            <p class="text-[19px]">Accept</p>
        </div>
        <div class="flex items-center sm:flex-row flex-col gap-3">
            <div class="{{ $data->status == "done" ? 'status-active' : 'status-non-active' }}">
                <p>4</p>
            </div>
            <p class="text-[19px]">Done</p>
        </div>
    </div>

    {{-- content --}}
    <div class="mt-8 p-6 border-t border-non-active">
        <p class="{{ $data->status == 'waiting' ? 'badge-status-waiting' : ($data->status == 'pending' ? 'badge-status-pending' : ($data->status == 'accept' ? 'badge-status-accept' : ($data->status == 'done' ? 'badge-status-done' : ''))) }}">{{ $data->status }}</p>
        {{-- form --}}
        <form action="{{ route('pertemuan.update', $data->id) }}" method="post">
            @method('patch')
            @csrf
            <div class="mt-5 flex gap-7 justify-between mx-auto">
                {{-- left --}}
                <div class="w-full">
                    <div class="">
                        <p class="font-semibold">Tema Pertemuan</p>
                        <input type="text" value="{{ $data->tema }}" disabled class="input-form">
                    </div>
                    <div class=" mt-3" {{ $data->tema == 'Bimbingan Karir' ? '' : 'hidden' }}>
                        <p class="font-semibold">Jenis Karir</p>
                        <input type="text" value="{{ $data->jenis_karir }}" disabled class="input-form">
                    </div>
                    <div class="mt-3">
                        <p class="font-semibold">Waktu Pertemuan</p>
                        <input type="datetime-local" value="{{ $data->tgl }}" disabled name="tgl" class="input-form">
                        <small class="font-semibold">Jadwal sebelumnya : {{ Carbon\Carbon::parse($data->tgl)->translatedFormat('l, d F Y H:i') }}</small>
                    </div>
                    <div class="mt-3">
                        <p class="font-semibold">Tempat Pertemuan</p>
                        <input type="text" value="{{ $data->tmpt }}" name="tmpt" disabled class="input-form">
                    </div>
                </div>
                <div class="border-l border-non-active"></div>
                {{-- right --}}
                <div class="w-full">
                    <div>
                        <p class="font-semibold">Deskripsi singkat <span class="text-non-active">(opsional)</span></p>
                        <textarea name="" disabled class="input-form" id="" cols="5">{{ $data->deskripsi }}</textarea>
                    </div>
                    <div class="mt-3" {{ $data->status == "accept" || $data->status == 'pending' && Auth::user()->role == 'guru' ? '': 'hidden' }}>
                        <p class="font-semibold">Kesimpulan</p>
                        <textarea name="kesimpulan" class="input-form" id="" cols="5">{{ $data->kesimpulan }}</textarea>
                    </div>
                </div>
            </div>
            {{-- button waiting --}}
            <div class="mt-5 flex items-center gap-3 {{ $data->status != 'waiting' || Auth::user()->role != 'guru' ? 'hidden' : '' }}"> 
                <button type="button" onclick="modal_reject.showModal()" class="btn-danger-form">Tunda</button>
                <button class="btn-primary-form">Terima</button>
            </div>
            {{-- button accept --}}
            <div class="mt-5 flex justify-end items-center gap-3 {{ $data->status != 'accept' && $data->status != 'pending' || Auth::user()->role != 'guru' ? 'hidden' : '' }}"> 
                <button class="btn-primary-form">Selesaikan</button>
            </div>
        </form>
    </div>
</div>
@endsection
