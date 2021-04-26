@extends('layouts.app')

@section('content')

@include('navbar')

<div class="py-4 pl-40 h-screen">

    @if(session('success'))
    <div class="w-72 p-2 flex border border-gray-200 bg-green-100 rounded-sm">
        <small class="text-sm">
            {{ session('success') }}       
        </small>
    </div>
    @endif

    <h3 class="font-bold text-2xl text-indigo-700 mb-4">Login</h3>
    <form action="{{ route('login') }}" class="flex flex-col space-y-4  w-72" method="POST">
        @csrf
        <input class="py-2 border-b-2 border-indigo-700 outline-none text-lg" type="text" name="email" placeholder="Email" value={{ old('email') }}>

        @error('email')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        <input class="py-2 border-b-2 border-indigo-700 outline-none text-lg" type="password" name="password" placeholder="Password">

        @error('password')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        <div class="">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </div>

        <input type="submit" class="cursor-pointer btn-indigo-invert w-72" value="Login">

        @if(session('status'))
        <small class="text-red-500 text-sm">
            {{ session('status') }}
        </small>
        @endif

    </form>
</div>

@include('footer')

@endSection