@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit data kelas</h3>

<form action="{{ route('classes.update', $class) }}" class="py-4 space-y-4 w-1/2" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama Kelas</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $class->nama }}">

        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" class="h-36 p-1 border border-gray-400 rounded-md flex-auto" style="resize: none">{{ $class->deskripsi }}</textarea>
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="instansi">Instansi</label>
        <input type="text" name="instansi" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $class->instansi }}">
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="cover_image">Foto Cover Kelas</label>
        <input type="file" name="cover_image" class="p-1 border border-gray-400 rounded-md flex-auto">
    </div>

    @error('instansi')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
    @endError

    <input type="submit" class="btn-indigo cursor-pointer" value="Update kelas">
</form>

@endSection