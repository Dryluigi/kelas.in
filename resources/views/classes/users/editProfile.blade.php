@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit profil</h3>

<form action="{{ route('classes.profile.update', $class) }}" class="py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->nama }}">

        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        @if(session('fail'))
            <small class="text-red-500 text-sm">
                {{ session('fail') }}
            </small>
        @endif      

    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="alamat">Alamat</label>
        <input type="text" name="alamat" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->alamat }}">

        @error('alamat')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nomor_telepon">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->nomor_telepon }}">

        @error('nomor_induk')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nomor_induk">Nomor Induk Kelas</label>
        <input type="text" name="nomor_induk" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $userClass->pivot->nomor_induk }}">

        @error('nomor_induk')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nomor_presensi">Nomor Presensi Kelas</label>
        <input type="text" name="nomor_presensi" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $userClass->pivot->nomor_presensi }}">

        @error('nomor_presensi')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>

    <input type="submit" class="btn-indigo cursor-pointer" value="Update data">
</form>


@endSection