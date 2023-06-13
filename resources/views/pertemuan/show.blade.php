@extends('layouts.mainLayout')

@section('title')
    Pertemuan
@endsection

@section('sub_title')
    Pertemuan
@endsection

@section('content')
    <div class="mt-12 rounded-[12px] w-5/6 h-[700px] mx-auto bg-white ">
        <div class="p-15">
            <div class="w-2/3 mx-auto flex justify-between my-5 p-10">
                <div class="w-10 h-10 rounded-full bg-primary">
                    <p class="text-center p-2 text-white">1</p>
                </div>
                <p class="text-center p-2">Waiting</p>
                <div class="w-10 h-10 rounded-full bg-non-active">
                    <p class="text-center p-2">2</p>
                </div>
                <p class="text-center p-2">Pending</p>
                <div class="w-10 h-10 rounded-full bg-non-active">
                    <p class="text-center p-2">3</p>
                </div>
                <p class="text-center p-2">Accept</p>
                <div class="w-10 h-10 rounded-full bg-non-active">
                    <p class="text-center p-2">4</p>
                </div>
                <p class="text-center p-2">Success</p>
            </div>
        </div>
        <div class="w-[97%] h-[60vh] p-3 mx-auto border-t border-non-active flex flex-col justify-center">
            <h1 class="text-center text-2xl text-yellow-300">Warning</h1>
            <div class="w-full mx-auto h-3/4  mt-8 flex justify-between">
                <div class="w-2/5">
                    <div class="w-36 mt-8 ml-16 text-left ">
                        <div class="mt-8">
                            <p class="text-sm font-semibold">Tema Konseling</p>
                        </div>
                        <div class="mt-3 ">
                            <input type="text"
                                class="w-72 rounded-md px-5 py-2 bg-secondary text-base font-semibold text-center"
                                value="" readonly>
                        </div>
                        <div class="mt-5">
                            <p class="text-sm font-semibold">Waktu Pertemuan</p>
                        </div>
                        <div class="mt-3">
                            <input type="text"
                                class="w-72 rounded-md px-5 py-2 bg-secondary text-center font-semibold text-base"
                                value="" readonly>
                        </div>
                        <div class="mt-5">
                            <p class="text-sm font-semibold">Tempat Pertemuan</p>
                        </div>
                        <div class="mt-3">
                            <input type="text"
                                class="w-72 rounded-md px-5 py-2 bg-secondary text-base font-semibold text-center"
                                value="" readonly>
                        </div>
                    </div>
                </div>
                <div class=" w-3/6 border-non-active ">
                    <div class="mt-8">
                        <p class="text-sm font-semibold">Deskripsi Singkat ( Opsional )</p>
                    </div>
                    <div class="mt-3">
                        <textarea class="bg-secondary p-2 text-base rounded-xl" rows="3" name="" id="" cols="30"
                            rows="10"></textarea>
                    </div>
                    <div class="mt-8">
                        <p class="text-sm font-semibold">Kesimpulan Pertemuan ( Hari Ini )</p>
                    </div>
                    <div class="mt-3">
                        <textarea class="bg-secondary p-2 text-base rounded-xl" rows="3" name="" id="" cols="30"
                            rows="10"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
