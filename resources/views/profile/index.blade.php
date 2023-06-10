@extends('layouts.mainLayout')

@section('title')
    Kelas
@endsection

@section('sub_title')
    Kelas
@endsection

@section('content')
<div class="mt-12 rounded-[12px] w-11/12 h-[350px] mx-auto bg-white ">
    <p class="font-semibold text-xl p-10">Profile</p>
    <div class="w-[97%] mx-auto border-t border-non-active flex">
        <div class="w-3/6 flex">
            <div class="w-24 h-24 mt-8 ml-4 bg-non-active rounded-full">
            </div>
            <div class="w-36 mt-8 ml-16 text-left">
                <p class="px-1 font-bold text-xl">Nama Admin</p>
                <p class="px-1 font-normal text-non-active">Super Admin</p>
                <p class="py-2 w-28 bg-primary text-xs text-center text-white rounded-md">Edit Profile</p>
            </div>
        </div>
        <div class=" w-3/6 h-40 border-l border-non-active mt-9 mr-16">
            <div class="ml-10 px-5">
                <p class="text-non-active">Contact Details</p>
                <div class="flex space-x mt-2">
                    <span class="material-symbols-outlined text-non-active">mail</span>
                    <p class="text-non-active ml-2">email@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
