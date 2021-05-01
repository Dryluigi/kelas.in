@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit mata pelajaran</h3>

<form action="{{ route('classes.courses.update', [$class, $course]) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama Mata Pelajaran</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $course->nama }}">

        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>
    <div class="flex flex-col space-y-2">
        <label for="pengajar">Pengajar</label>
        <input type="text" name="pengajar" class="p-1 border border-gray-400 rounded-md" value="{{ $course->pengajar }}">

        @error('pengajar')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label for="day_id">Hari</label>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="day_id">
            @foreach($days as $day)
                <option value="{{ $day->id }}" @if($day->id === $course->day_id) selected @endif>{{ $day->hari }}</option>
            @endforeach
        </select>
    </div>  
    <div class="flex flex-col space-y-2">
        <label for="start">Waktu mulai</label>
        <input type="time" name="start" class="p-1 border border-gray-400 rounded-md" value="{{ $course->start }}">

        @error('start')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label for="end">Waktu berakhir</label>
        <input type="time" name="end" class="p-1 border border-gray-400 rounded-md" value="{{ $course->end }}">

        @error('end')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label for="course_group_id">Kelompok</label>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="course_group_id">
            @foreach($groups as $group)
                <option value="{{ $group->id }}" @if($group->id === $course->course_group_id) selected @endif>{{ $group->nama }}</option>
            @endforeach
        </select>
    </div>  

    <input type="submit" class="btn-indigo cursor-pointer" value="Update mata pelajaran">
</form>


@endSection