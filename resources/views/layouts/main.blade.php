@extends('layouts.app')

@section('content')

<div class="h-screen flex flex-col">
    <nav class="flex justify-between px-6 py-4 items-center">
        <h1 class="text-2xl font-bold">Kelas.IN</h1>
        <div class="flex space-x-4">
            <a href="">
                <div class="btn-indigo hover:btn-indigo-invert">Login</div>
            </a>
            <a href="">
                <div class="btn-indigo-invert hover:btn-indigo">Register</div>
            </a>
        </div>
    </nav>
</div>

@yield('content')

@include('footer')


@endSection