@extends('layouts.mainLayout')

@section('title')
    Profile - DeepTalk
@endsection

@section('sub_title')
    Profile
@endsection

@section('content')
<div class="my-12 mx-auto bg-white sm:w-11/12 w-4/5 rounded-2xl h-fit p-7 shadow-md">
    <div class="flex justify-start">
        <p class="text-lg font-bold ">{{ 'Profile' }}</p>
    </div>
    <div class="flex sm:flex-row flex-col justify-between mt-7 px-3 py-8 border-t-2 border-non-active">
        {{-- left --}}
        <div class="flex gap-14 items-center sm:flex-row flex-col">
            <div class="w-[100px] h-[100px] bg-non-active rounded-full overflow-clip">
                <img src="{{ Auth::user()->profile != 'img/profile.png' ? asset('storage/'.Auth::user()->profile) : asset(Auth::user()->profile) }}" alt="">
            </div>
            <div class="flex sm:items-start items-center flex-col gap-3">
                <p class="text-[20px] font-bold leading-5">{{ Auth::user()->nama }}</p>
                <p class="text-base font-semibold leading-3 text-non-active">{{ Auth::user()->role }}</p>
                <a href="{{ route('profile.formedit') }}" class="btn-primary-form">Edit Profile</a>
            </div>
        </div>
        <div class="sm:border-l border-l-0 border-non-active px-9 py-3 sm:items-start items-center flex flex-col gap-4">
            <p class="text-non-active font-semibold text-[13px] leading-3">Contact Details</p>
            
            <div class="flex gap-2 items-center">
                <span class="material-symbols-outlined text-non-active">mail</span>
                <p class="text-[13px] text-non-active">{{ Auth::user()->email }}</p>
            </div>
        </div>
        {{-- right --}}
        <div class="">
        </div>
    </div>
</div>
@endsection
