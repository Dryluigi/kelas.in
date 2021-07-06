@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Buat tugas baru</h3>

<form action="{{ route('classes.assignments.update', [$class, $assignment]) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="judul">Judul tugas</label>
        <input type="text" name="judul" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $assignment->judul }}">

        @error('judul')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>

    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="deskripsi">Deskripsi tugas</label>
        <textarea name="deskripsi" class="h-36 p-1 border border-gray-400 rounded-md flex-auto" style="resize: none">{{ $assignment->deskripsi }}</textarea>
    </div>

    <div class="flex flex-col space-y-2">
        <label for="deadline">Deadline</label>
        <input type="datetime" name="deadline" class="p-1 border border-gray-400 rounded-md" value="{{ $assignment->deadline }}">

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
                <option value="{{ $course->id }}" @if($assignment->course_id === $course->id) selected @endif>{{ $course->nama }}</option>
            @endforeach
        </select>
    </div>  

    <input type="submit" class="btn-indigo cursor-pointer" value="Update tugas">
</form>


@endSection