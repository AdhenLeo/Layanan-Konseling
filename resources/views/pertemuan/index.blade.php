@extends('layouts.mainLayout')

@section('title')
    Pertemuan
@endsection

@section('sub_title')
    Pertemuan
@endsection

@section('content')
<div class="my-7 mx-auto bg-white sm:w-11/12 w-4/5 overflow-auto rounded-2xl h-fit p-5 shadow-md">
    <div class="flex sm:flex-row flex-col sm:gap-0 gap-3 justify-between">
        <p class="text-lg font-bold">Pertemuan</p>
        <a href="{{ route('pertemuan.create') }}" class=" text-center btn-primary">Tambah Pertemuan</a>
    </div>
    {{-- table --}}
    <div class="mt-10 mx-auto border-t border-non-active p-5">
        {{-- card --}}
        <a href="" class="flex mb-5 hover:bg-non-active hover:bg-opacity-5 transition-colors rounded-xl py-4 px-5 w-full sm:flex-row flex-col overflow-auto shadow-card justify-between items-center">
            {{-- left --}}
            <div class="flex sm:flex-row flex-col items-center gap-7">
                <div class="rounded-full bg-non-active p-3">
                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M41.1996 36.9141C38.7896 32.6843 35.0263 29.3885 30.5156 27.5573C32.7587 25.8749 34.4157 23.5294 35.2517 20.8531C36.0877 18.1767 36.0605 15.3052 35.1738 12.6451C34.2871 9.98513 32.586 7.67153 30.3114 6.03206C28.0367 4.39259 25.3039 3.51038 22.5 3.51038C19.6961 3.51038 16.9633 4.39259 14.6886 6.03206C12.414 7.67153 10.7128 9.98513 9.82618 12.6451C8.93951 15.3052 8.91226 18.1767 9.74829 20.8531C10.5843 23.5294 12.2413 25.8749 14.4844 27.5573C9.97369 29.3885 6.21042 32.6843 3.80038 36.9141C3.65105 37.1542 3.55152 37.4219 3.50771 37.7013C3.4639 37.9806 3.4767 38.2659 3.54536 38.5402C3.61402 38.8146 3.73713 39.0723 3.90738 39.298C4.07762 39.5238 4.29153 39.7131 4.53637 39.8545C4.78121 39.996 5.052 40.0868 5.33263 40.1215C5.61327 40.1562 5.89801 40.1341 6.16995 40.0566C6.44188 39.9791 6.69546 39.8477 6.91559 39.6702C7.13572 39.4927 7.31792 39.2728 7.45136 39.0235C10.6365 33.518 16.2615 30.2344 22.5 30.2344C28.7385 30.2344 34.3635 33.5198 37.5486 39.0235C37.8378 39.4885 38.2965 39.8228 38.8277 39.9557C39.3589 40.0887 39.921 40.0099 40.3951 39.7359C40.8692 39.462 41.2183 39.0144 41.3684 38.4878C41.5185 37.9612 41.458 37.3969 41.1996 36.9141ZM13.3594 16.875C13.3594 15.0672 13.8955 13.2999 14.8998 11.7968C15.9042 10.2936 17.3318 9.12202 19.002 8.43019C20.6723 7.73836 22.5101 7.55734 24.2832 7.91003C26.0563 8.26273 27.6851 9.13329 28.9634 10.4116C30.2417 11.69 31.1123 13.3187 31.465 15.0918C31.8177 16.8649 31.6367 18.7028 30.9448 20.373C30.253 22.0432 29.0814 23.4708 27.5783 24.4752C26.0751 25.4796 24.3078 26.0157 22.5 26.0157C20.0766 26.0129 17.7533 25.0489 16.0397 23.3353C14.3261 21.6217 13.3622 19.2984 13.3594 16.875Z" fill="#ffffff"/>
                    </svg>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="flex sm:flex-row flex-col gap-4 items-center">
                        <p class="font-bold text-[17px] sm:min-w-0 min-w-15">Ahmad Ali Hamzah</p>
                        <p class="text-primary font-semibold text-[15px] sm:hidden block">Konsultasi pribadi</p>
                    </div>
                    <p class="text-primary font-semibold sm:block hidden text-[15px]">Konsultasi pribadi</p>
                    <div class="mt-4">
                        <p class="text-[13px] font-semibold text-non-active">Jadwal: Sabtu, 12 Juni 2023</p>
                    </div>
                </div>
            </div>
            {{-- right --}}
            <div class="flex gap-4 sm:mt-0 mt-5">
                <p class="badge-primary">Waiting</p>
            </div>
        </a>
    </div>
    {{-- pagination --}}
    <div class="mt-5">
    </div>
</div>
@endsection