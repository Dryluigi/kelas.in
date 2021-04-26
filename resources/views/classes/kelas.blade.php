@extends('layouts.dashboard')

@section('content')

<div class="flex justify-end pb-4">
    <a href="{{ route('kelas.create') }}">
        <div class="btn-indigo">Buat kelas</div>
    </a>
</div>
<div class="overflow-y-auto">
    <div class="h-72 flex space-x-4 py-2">
        <div class="border border-gray-300 rounded-lg h-full w-72 flex flex-col overflow-hidden">
            <div class="h-20 bg-red-400 flex-none">
                <h4 class="text-2xl text-white font-bold">D4 IT A 2019</h4>
            </div>
            <div class="flex-auto px-2">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quod iste vel tempora minima, totam veritatis esse, doloribus ad labore excepturi facilis eum quisquam modi expedita. Unde dicta illum magnam?
            </div>
            <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">Politeknik Elektronika Negeri Surabaya</div>
        </div>

        <div class="border border-gray-300 rounded-lg h-full w-72 flex flex-col overflow-hidden">
            <div class="h-20 bg-pink-400 flex-none">
                <h4 class="text-2xl text-white font-bold">D4 IT B 2019</h4>
            </div>
            <div class="flex-auto px-2">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quod iste vel tempora minima, totam veritatis esse, doloribus ad labore excepturi facilis eum quisquam modi expedita. Unde dicta illum magnam?
            </div>
            <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">Politeknik Elektronika Negeri Surabaya</div>
        </div>

        <div class="border border-gray-300 rounded-lg h-full w-72 flex flex-col overflow-hidden">
            <div class="h-20 bg-pink-400 flex-none">
                <h4 class="text-2xl text-white font-bold">D4 IT B 2019</h4>
            </div>
            <div class="flex-auto px-2">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quod iste vel tempora minima, totam veritatis esse, doloribus ad labore excepturi facilis eum quisquam modi expedita. Unde dicta illum magnam?
            </div>
            <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">Politeknik Elektronika Negeri Surabaya</div>
        </div>

    </div>
    <div class="h-72 flex py-2 bg-yellow-200">

    </div>
    <div class="h-72 flex py-2 bg-green-200">

    </div>
</div>


@endSection