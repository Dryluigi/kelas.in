@extends('layouts.dashboard')

@section('content')

<h3 class="text-xl font-bold">Buat kelas baru</h3>

<form action="{{ route('classes') }}" class="py-4 space-y-4 w-1/2" method="POST">
    @csrf
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama Kelas</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto">

        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" class="h-36 p-1 border border-gray-400 rounded-md flex-auto" style="resize: none"></textarea>
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="instansi">Instansi</label>
        <input type="text" name="instansi" class="p-1 border border-gray-400 rounded-md flex-auto">
    </div>

    @error('instansi')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
    @endError

    <input type="submit" class="btn-indigo cursor-pointer" value="Buat kelas">
</form>

@endSection