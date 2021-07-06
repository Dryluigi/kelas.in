@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Buat tugas baru</h3>

<form action="{{ route('classes.assignments', $class) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="judul">Judul tugas</label>
        <input type="text" name="judul" class="p-1 border border-gray-400 rounded-md flex-auto">

        @error('judul')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>

    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="deskripsi">Deskripsi tugas</label>
        <textarea name="deskripsi" class="h-36 p-1 border border-gray-400 rounded-md flex-auto" style="resize: none"></textarea>
    </div>

    <div class="flex flex-col space-y-2">
        <label for="deadline">Deadline</label>
        <input type="datetime-local" name="deadline" class="p-1 border border-gray-400 rounded-md">

        @error('deadline')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    
    <div class="flex flex-col space-y-2">
        <label for="course_id">Mata pelajaran</label>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="course_id">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->nama }}</option>
            @endforeach
        </select>
    </div>  

    <input type="submit" class="btn-indigo cursor-pointer" value="Buat tugas">
</form>


@endSection