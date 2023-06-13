@extends('layouts.mainLayout')

@section('title')
    Siswa
@endsection

@section('sub_title')
    Siswa
@endsection

@section('content')
<div class="my-12 mx-auto bg-white sm:w-11/12 w-4/5 rounded-2xl h-fit p-5 shadow-md">
    <div class="flex justify-start">
        <p class="text-lg font-bold">Siswa</p>
    </div>
    {{-- table --}}
    <div class="mt-5 overflow-auto">
        <table class="w-full" cellpadding='10' cellspacing='0'>
            <thead class="text-non-active border-b border-non-active">
                <th>
                    <p class="min-w-20 overflow-auto">Nama</p>
                </th>
                <th>
                    <p class="min-w-20">Email</p>
                </th>
                <th>
                    <p class="min-w-15">Kelas</p>
                </th>
                <th>
                    <p class="min-w-10">Aksi</p>
                </th>
            </thead>
            <tbody>
                @foreach ($datas->user as $i => $data)
                    @if ($data->role == 'user')
                    <tr class="border-b border-non-active">
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                            <div class="grid grid-cols-3 gap-2">
                            @foreach ($data->kelas as $kelas)
                                <p class="tag">{{ $kelas->nama }}</p>
                            @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2 items-center">
                                <a href="{{ route('user.show', $data->id) }}" class="text-detail">
                                    <span class="material-symbols-outlined">
                                        info
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
