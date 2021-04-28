@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit post</h3>

<form action="{{ route('classes.posts.update', [$class, $post]) }}" class="py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="judul">Judul</label>
        <input type="text" name="judul" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $post->judul }}">

        @error('judul')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>
    <div class="flex flex-col space-y-2 h-64">
        <textarea type="text" name="isi" class="p-1 border border-gray-400 rounded-md flex-auto min-h-full">{{ $post->isi }}</textarea>

        @error('isi')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>

    <input type="submit" class="btn-indigo cursor-pointer" value="Update data">
</form>


@endSection