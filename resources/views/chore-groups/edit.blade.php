@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit kelompok piket</h3>

<form action="{{ route('classes.chore-groups.update', [$class, $group]) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama Kelompok Piket</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $group->nama }}">

        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>

    <div class="flex flex-col space-y-2 h-64">
        <label for="deskripsi">Deskripsi Kelompok Piket</label>
        <textarea type="text" name="deskripsi" class="p-1 border border-gray-400 rounded-md flex-auto">{{ $group->deskripsi }}</textarea>

        @error('deskripsi')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex space-x-2 items-center">
        <input type="checkbox" name="is_active" class="p-1 border border-gray-400 rounded-md" @if($group->is_active === 1) checked @endif>
        <label for="is_active">Apakah kelompok piket aktif?</label>
    </div>

    <input type="submit" class="btn-indigo cursor-pointer" value="Update data">
</form>


@endSection