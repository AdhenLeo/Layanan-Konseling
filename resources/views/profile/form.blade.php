@extends('layouts.mainLayout')

@section('title')
    {{ isset($data) ? 'Edit Kelas' : 'Tambah Kelas' }}
@endsection

@section('sub_title')
    {{ isset($data) ? 'Edit Kelas' : 'Tambah Kelas' }}
@endsection

@section('content')
<div class="w-11/12 flex mx-auto space-x-8">
    <div class="mt-14 rounded-[12px] w-2/5 h-2/3 bg-white ">
        <p class="font-semibold text-xl p-10">Update Profile</p>
        <div class="w-[97%] mx-auto border-t border-non-active flex">
            <div class="w-11/12 flex justify-between">
                <div class="w-24 h-24 mt-8 ml-10 bg-non-active rounded-full"></div>
                <div class="mt-10 text-left">
                    <p class="w-40 px-1 font-bold text-xl">Nama Admin</p>
                    <p class="w-40 px-1 mt-2 font-normal text-non-active">Super Admin</p>
                </div>
                <div>
                    <span class="material-symbols-outlined mt-10 mr-3">more_horiz</span>
                </div>
            </div>
        </div>
        <div class="w-[75%] h-36 mt-10 mx-auto border-t border-non-active flex">
            <div class="w-[100%] mt-5 bg-primary">
                <p class="text-xs font-semibold">Kelas</p>
                <div class="w-full flex justify-between">

                </div>
            </div>
        </div>
    </div>

    <div class="mt-14 rounded-[12px] w-7/12 bg-white ">
        <p class="font-semibold text-xl p-10">Display Information</p>
        <div class="w-[97%] mx-auto border-t border-non-active flex">
            <div class="ml-4">
                <div class="w-3/6 mt-12">
                    <p class="text-sm font-semibold">Username</p>
                </div>
                    <div class="mt-3">
                        <input type="text" class="w-72 rounded-md px-5 py-2 bg-secondary text-sm" placeholder="Username Anda">
                    </div>
                        <div class="w-3/6 mt-5">
                            <p class="text-sm font-semibold">Email</p>
                        </div>
                    <div class="mt-3">
                        <input type="text" class="w-72 rounded-md px-5 py-2 bg-secondary text-sm" placeholder="email@email.com">
                </div>
            </div>
            <div class="mt-12 ml-14">
                <div class="w-40 h-48 border-dashed border-2 border-non-active">
                    <div class="w-24 h-24 m-auto mt-4 bg-non-active rounded-full"></div>
                    <p class="py-2 w-28 m-auto mt-8 bg-primary text-xs text-center text-white rounded-md">Change Photo</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
