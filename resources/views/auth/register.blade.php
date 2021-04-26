@extends('layouts.app')

@section('content')

@include('navbar')

<div class="py-4 pl-40 h-screen">
    <h3 class="font-bold text-2xl text-indigo-700 mb-4">Register</h3>
    <form action="{{ route('register') }}" class="flex flex-col space-y-4" method="POST">
        @csrf
        <input class="py-2 border-b-2 border-indigo-700 outline-none w-72 text-lg" type="text" name="email" placeholder="Email">

        @error('email')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        @if(session('duplicatedEmail'))
        <small class="text-red-500 text-sm">
            {{ session('duplicatedEmail') }}
        </small>
        @endif

        <input class="py-2 border-b-2 border-indigo-700 outline-none w-72 text-lg" type="password" name="password" placeholder="Password">

        @error('password')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        <input class="py-2 border-b-2 border-indigo-700 outline-none w-72 text-lg" type="password" name="password_confirmation" placeholder="Confirm password">

        @error('password_confirmation')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        <input type="submit" class="cursor-pointer btn-indigo-invert w-72" value="Register">
    </form>
</div>

@include('footer')

@endSection