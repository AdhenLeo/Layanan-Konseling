@extends('layouts.mainLayout')

@section('title')
    Users
@endsection

@section('sub_title')
    Users
@endsection

@section('content')
    <div class="my-12 mx-auto bg-white sm:w-11/12 w-4/5 rounded-2xl h-fit p-5 shadow-md">
        <div class="flex justify-between">
            <p class="text-lg font-bold">User</p>
            <a href="{{ route('user.create') }}" class="btn-primary">Tambah User</a>
        </div>
        {{-- table --}}
        <div class="mt-5 overflow-auto">
            <table class="w-full" cellpadding='10' cellspacing='0'>
                <thead class="text-non-active border-b border-non-active">
                    <th>
                        <p>No</p>
                    </th>
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
                        <p class="min-w-20">Aksi</p>
                    </th>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr class="border-b border-non-active">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                @foreach ($data->kelas as $kelas)
                                    {{ $kelas->nama }}
                                @endforeach
                            </td>
                            <td>
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('user.show', $data->id) }}" class="text-detail">
                                        <span class="material-symbols-outlined">
                                            info
                                        </span>
                                    </a>
                                    <a href="{{ route('user.edit', $data->id) }}" class="text-warning">
                                        <span class="material-symbols-outlined">
                                            discover_tune
                                        </span>
                                    </a>
                                    <form action="{{ route('user.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="text-danger">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </button>
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
