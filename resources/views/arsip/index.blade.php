@extends('layouts.mainLayout')

@section('title')
    Arsip - DeepTalk
@endsection

@section('sub_title')
    Arsip
@endsection

@section('content')
    <div class="my-12 mx-auto bg-white sm:w-11/12 w-4/5 rounded-2xl h-fit p-5 shadow-md">
        <div class="flex justify-start">
            <p class="text-lg font-bold">Arsip</p>
        </div>
        {{-- table --}}
        <div class="mt-5 overflow-auto">
            <table class="w-full" cellpadding='10' cellspacing='0'>
                <thead class="text-non-active border-b border-non-active">
                    <th>
                        <p>No</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-15">Nama Siswa</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-15">Nama Guru</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-15">Tanggal</p>
                    </th>
                    <th>
                        <p class="">Status</p>
                    </th>
                </thead>
                <tbody>
                    @foreach ($datas as $i => $data)
                        <tr class="border-b border-non-active">
                            <td>{{ $i + $datas->firstItem() }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->guru->nama }}</td>
                            <td>{{ Carbon\Carbon::parse($data->tgl)->translatedFormat('l, d F Y H:i') }}</td>
                            <td>
                                <p class="badge-primary w-fit">{{ $data->status }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $datas->links() }}
        </div>
    </div>
@endsection
