@extends('layouts.mainLayout')

@section('title')
    {{ isset($data) ? 'Edit Pertemuan - DeepTalk' : 'Tambah Pertemuan - DeepTalk' }}
@endsection

@section('sub_title')
    {{ isset($data) ? 'Edit Pertemuan' : 'Tambah Pertemuan' }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/drag&drop.css') }}">
@endpush

@section('content')
<div class="my-7 mx-auto bg-white sm:w-[94%] w-4/5 rounded-2xl item h-fit p-5 shadow-md">
    <div>
        <p class="text-lg font-bold">{{ isset($data) ? 'Edit Pertemuan' : 'Tambah Pertemuan' }}</p>
    </div>
    
    <form action="{{ route('pertemuan.store') }}" method="POST">
        @csrf
        <div class="mt-11 w-full">
            <div class="">
                <p class="font-semibold text-base text-non-active mb-2">Tema</p>
                <select {{ isset($data) ? 'disabled' : '' }} name="tema" id="tema" required class="input-select">
                    <option value="" selected hidden>Pilih Tema</option>
                    @foreach ($temas as $tema)
                    <option value='{{ $tema }}' {{ isset($data) ? ($data->jenis == $tema ? "selected" : "") : '' }}>{{ $tema }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3" hidden id="jenisKarir">
                <p class="font-semibold text-base text-non-active mb-2">Jenis Karir</p>
                <select {{ isset($data) ? 'disabled' : '' }} name="jenis_karir" id="jenisKarir" class="input-select">
                    <option value="" selected hidden>Pilih Jenis Karir</option>
                    @foreach ($jeniskarirs as $jenis)
                    <option value='{{ $jenis }}' {{ isset($data) ? ($data->jenis_karir == $jenis ? "selected" : "") : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div hidden id="content">
                {{-- content --}}
                <div class="mt-3" id="murid" {{ Auth::user()->role != 'guru' ? 'hidden' : '' }}>
                    <p class="font-semibold text-base text-non-active mb-2">Murid</p>
                    <select {{ isset($data) ? 'disabled' : '' }} multiple name="user_id[]" id="user_id" class="input-select">
                        @if (Auth::user()->role == 'guru')
                            @foreach ($siswas as $siswa)
                            <option value='{{ $siswa->user->id }}' {{ isset($data) ? ($data->user_id == $siswa->user->id ? "selected" : "") : '' }}>{{ $siswa->user->nama }}</option>
                            @endforeach
                        @elseif(Auth::user()->role == 'user')
                            @foreach ($siswas as $siswa)
                            <option value='{{ $siswa->id }}' {{ isset($data) ? ($data_id == $siswa->id ? "selected" : "") : '' }}>{{ $siswa->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Tanggal Pertemuan</p>
                    <input type="datetime-local" class='input-form' name="tgl" value="{{ isset($data) ? $data->tgl : old('tgl') }}" required>
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Tempat Pertemuan</p>
                    <textarea name="tmpt" class="input-form" id="" required>{{ isset($data) ? $data->tmpt : old('tmpt') }}</textarea>
                </div>
                <div class="mt-3">
                    <p class="font-semibold text-base text-non-active mb-2">Deskripsi Singkat (opsional)</p>
                    <textarea name="deskripsi" class="input-form" id="" {{ isset($data) ? 'disabled' : '' }}>{{ isset($data) ? $data->tmpt : old('tmpt') }}</textarea>
                </div>
            </div>
            <div class="mt-7 sm:flex-row flex flex-row-reverse gap-4">
                <button class="btn-primary-form">{{ isset($data) ? 'Ubah' : 'Buat' }}</button>
                <a href="{{ route('pertemuan.index') }}" class="btn-back-form">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
    <script>
        $('#tema').change(function (e) { 
            console.log($(this).val())
            $(this).val() == 'Bimbingan Karir' ? $("#jenisKarir").removeAttr('hidden') : $('#jenisKarir').attr('hidden', true);;

            if('{{ Auth::user()->role }}' == 'user'){
                $(this).val() == 'Bimbingan Sosial' ? $("#murid").removeAttr('hidden') : $('#murid').attr('hidden', true);
                $(this).val() == 'Bimbingan Sosial' ? $("#murid").removeAttr('hidden') : $('#murid').attr('disabled', true);
            }

            $(this).val() == '' ? $('#content').attr('hidden', true) : $('#content').removeAttr('hidden');
        });

        new MultiSelectTag('user_id')

    </script>
@endpush