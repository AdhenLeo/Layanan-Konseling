@extends('layouts.mainLayout')

@section('title')
    Arsip
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
                <th><p>No</p></th>
                <th><p class="sm:min-w-0 min-w-15">Nama Siswa</p></th>
                <th><p class="sm:min-w-0 min-w-15">Nama Guru</p></th>
                <th><p class="sm:min-w-0 min-w-15">Tanggal</p></th>
                <th><p class="">Status</p></th>
            </thead>
            <tbody>
                <tr class="border-b border-non-active">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p class="mx-auto badge-success">Selesai</p></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{-- {{ $datas->links() }} --}}
    </div>
</div>
@endsection