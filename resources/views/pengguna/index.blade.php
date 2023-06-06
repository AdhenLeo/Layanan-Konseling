@extends('layouts.mainLayout')

@section('title')
Pengguna
@endsection

@section('sub_title')
    Pengguna
@endsection

@section('content')
<div class="my-12 mx-auto bg-white sm:w-3/4 w-4/5 rounded-2xl h-fit p-5 shadow-md">
    <div class="flex justify-between">
        <p class="text-lg font-bold">Pengguna</p>
        <a href="{{ route('pengguna.create') }}" class="btn-primary">Tambah Pengguna</a>
    </div>
    {{-- table --}}
    <div class="mt-5 overflow-auto">
        <table class="w-full" cellpadding='10' cellspacing='0'>
            <thead class="text-non-active border-b border-non-active">
                <th><p>No</p></th>
                <th><p class="min-w-20">Nama</p></th>
                <th><p class="min-w-20">Email</p></th>
                <th><p class="min-w-15">Kelas</p></th>
                <th><p class="min-w-20">Aksi</p></th>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr class="border-b border-non-active">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->kelas->nama }}</td>
                    <td>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('pengguna.show', $data->id) }}" class="btn-detail">Detail</a>
                            <a href="{{ route('pengguna.edit', $data->id) }}" class="btn-warning">Edit</a>
                            <form action="{{ route('pengguna.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn-danger">Hapus</button>
                            </form>
                        </div>
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