@extends('layouts.app')

@section('content')
<div class="h-screen flex flex-col">

    @include('navbar')

    <header class="px-6 flex-auto flex flex-col justify-center bg-cover bg-center" style="background-image: url('{{ asset('storage/cover.jpg') }}');">
        <div class="w-3/4 space-y-2">
            <h2 class="text-5xl font-bold bg-white text-indigo-700 inline-block p-2">Atur kelasmu dengan mudah</h2>
            <p class="text-white text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quos labore. Corrupti quisquam debitis, nisi praesentium deserunt optio modi iure totam impedit mollitia ea maxime autem nihil ab id placeat!</p>
            <button class="btn-indigo text-xl">Buat kelasmu</button>
        </div>
        
    </header>
</div>

<section class="mt-4">
    <h2 class="text-2xl font-bold text-indigo-700 text-center">Fitur-fitur Unggulan</h2>
    <div class="flex justify-evenly space-x-2 py-4">
        <div class="bg-green-200 h-72 w-60"></div>
        <div class="bg-blue-200 h-72 w-60"></div>
    </div>
</section>

@include('footer')
@endSection