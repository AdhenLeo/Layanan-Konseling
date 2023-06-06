@extends('layouts.mainLayout')

@section('title')
    Kelas
@endsection

@section('sub_title')
    Kelas
@endsection

@section('content')
<div class="my-12 mx-auto bg-white sm:w-3/4 w-4/5 rounded-2xl h-fit p-5 shadow-md">
    <div class="flex justify-between">
        <p class="text-lg font-bold">Kelas</p>
        <a href="{{ route('kelas.create') }}" class="btn-primary">Tambah Kelas</a>
    </div>
    {{-- table --}}
    <div class="mt-5 overflow-auto">
        <table class="w-full" cellpadding='10' cellspacing='0'>
            <thead class="text-non-active border-b border-non-active">
                <th><p>No</p></th>
                <th><p class="sm:min-w-0 min-w-10">Nama Kelas</p></th>
                <th><p class="sm:min-w-0 min-w-15">Dibuat</p></th>
                <th><p class="sm:min-w-0 min-w-15">Diubah</p></th>
                <th><p class="sm:min-w-0 min-w-20">Aksi</p></th>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr class="border-b border-non-active">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->created_at->diffForHumans() }}</td>
                    <td>{{ $data->updated_at->diffForHumans() }}</td>
                    <td>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('kelas.show', $data->id) }}" class="btn-detail">Detail</a>
                            <a href="{{ route('kelas.edit', $data->id) }}" class="btn-warning">Edit</a>
                            <form action="{{ route('kelas.destroy', $data->id) }}" method="POST">
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