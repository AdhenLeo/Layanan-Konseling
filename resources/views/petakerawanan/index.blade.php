@extends('layouts.mainLayout')

@section('title')
    Peta Kerawanan
@endsection

@section('sub_title')
    Peta Kerawanan 
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/drag&drop.css') }}">
@endpush

@section('modal')
@include('partials.modals.modalimport')
@endsection

@section('content')
    <div class="my-12 mx-auto bg-white sm:w-11/12 w-4/5 rounded-2xl h-fit p-5 shadow-md">
        <div class="flex sm:flex-row flex-col sm:gap-0 gap-3 justify-between">
            <p class="text-lg font-bold">Peta Kerawanan</p>
            <div class="flex sm:flex-row flex-col-reverse gap-3">
                <button type="button" onclick="modal_import.showModal()" class="btn-primary">Import Peta Kerawanan</button>
                <a href="{{ route('petakerawanan.create') }}" class="text-center btn-primary">Tambah Peta Kerawanan</a>
            </div>
        </div>
        {{-- table --}}
        <div class="mt-5 overflow-auto">
            <table class="w-full" cellpadding='10' cellspacing='0'>
                <thead class="text-non-active border-b border-non-active">
                    <th>
                        <p>No</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-20">Jenis Peta Kerawanan</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-15">Dibuat</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-15">Diubah</p>
                    </th>
                    <th>
                        <p class="sm:min-w-0 min-w-10">Aksi</p>
                    </th>
                </thead>
                <tbody>
                    @foreach ($datas as $i => $data)
                        <tr class="border-b border-non-active">
                            <td>{{ $i + $datas->firstItem() }}</td>
                            <td>{{ $data->jenis }}</td>
                            <td>{{ $data->created_at->diffForHumans() }}</td>
                            <td>{{ $data->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('petakerawanan.edit', $data->id) }}" class="text-warning">
                                        <span class="material-symbols-outlined">
                                            discover_tune
                                        </span>
                                    </a>
                                    <form action="{{ route('petakerawanan.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="">
                                            <span class="material-symbols-outlined text-danger">
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
@push('js')
<script>
    var validExtensions = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'] ;
    var tipe = 'file';
</script>
<script src="{{ asset('assets/js/drag&drop.js') }}"></script>
@endpush