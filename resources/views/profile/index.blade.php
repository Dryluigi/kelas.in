@extends('layouts.dashboard')

@section('content')

<h3 class="text-xl font-bold">Profilmu</h3>

<form action="{{ route('profile.update') }}" class="py-4 space-y-4 w-1/2" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama Lengkap</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->nama }}">
        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="alamat">Alamat</label>
        <input type="text" name="alamat" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->alamat }}">
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->tanggal_lahir }}">
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nomor_telepon">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $user->user->nomor_telepon }}">
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="foto_profil">Foto Profil</label>
        <input type="file" name="foto_profil" class="p-1 border border-gray-400 rounded-md flex-auto">
    </div>
    <input type="submit" class="btn-indigo cursor-pointer" value="Update">
    
    @if(session('success'))
    <div class="p-2 flex border border-gray-200 bg-green-100 rounded-sm">
        <small class="text-sm">
            {{ session('success') }}       
        </small>
    </div>
    @endif
</form>
@endSection