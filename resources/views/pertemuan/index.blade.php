@extends('layouts.mainLayout')

@section('title')
    Pertemuan - DeepTalk
@endsection

@section('sub_title')
    Pertemuan
@endsection

@section('content')
<div class="my-7 mx-auto bg-white sm:w-11/12 w-4/5 overflow-auto rounded-2xl h-fit p-5 shadow-md">
    <div class="flex sm:flex-row flex-col sm:gap-0 gap-3 justify-between">
        <p class="text-lg font-bold">Pertemuan</p>
        <div class="flex gap-3">
            <a href="{{ route('pertemuan.export') }}" class=" text-center btn-primary {{ Auth::user()->role != 'guru' ? 'hidden' : '' }}">Export Pertemuan</a>
            <a href="{{ route('pertemuan.create') }}" class=" text-center btn-primary">Tambah Pertemuan</a>
        </div>
    </div>
    {{-- table --}}
    <div class="mt-10 mx-auto border-t border-non-active p-5">
        {{-- card --}}
        @foreach ($datas as $data)
        <a href="{{ route('pertemuan.show', $data->id) }}" class="flex mb-5 hover:bg-non-active hover:bg-opacity-5 transition-colors rounded-xl py-4 px-5 w-full sm:flex-row flex-col overflow-auto shadow-card justify-between items-center">
            {{-- left --}}
            <div class="flex sm:flex-row flex-col items-center gap-7">
                <div class="rounded-full bg-non-active overflow-clip w-16 h-16">
                    <img src="{{ $data->user->profile != 'img/profile.png' ? asset('storage/'.$data->user->profile) : asset($data->user->profile) }}" alt="">
                </div>
                <div class="flex flex-col justify-between">
                    <div class="flex sm:flex-row flex-col gap-4 items-center">
                        <p class="font-bold text-[17px] sm:min-w-0 min-w-15">{{ $data->user->nama }}</p>
                        <p class="text-primary font-semibold text-[15px] sm:hidden block">{{ $data->tema }}</p>
                    </div>
                    <p class="text-primary font-semibold sm:block hidden text-[15px]">{{ $data->tema }}</p>
                    <div class="mt-4">
                        <p class="text-[13px] font-semibold text-non-active">Jadwal: {{ Carbon\Carbon::parse($data->tgl)->translatedFormat('l, d F Y H:i') }}</p>
                    </div>
                </div>
            </div>
            {{-- right --}}
            <div class="flex gap-4 sm:mt-0 mt-5">
                <p class="{{ $data->status == "accept" ? 'badge-success' : ($data->status == 'pending' ? 'badge-warning' : 'badge-primary') }}">{{ $data->status }}</p>
            </div>
        </a>
        @endforeach
    </div>
    {{-- pagination --}}
    <div class="mt-5">
        {{ $datas->links() }}
    </div>
</div>
@endsection