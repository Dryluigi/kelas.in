@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Buat mata pelajaran</h3>

<form action="{{ route('classes.courses', $class) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nama">Nama Mata Pelajaran</label>
        <input type="text" name="nama" class="p-1 border border-gray-400 rounded-md flex-auto">

        @error('nama')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>
    <div class="flex flex-col space-y-2">
        <label for="pengajar">Pengajar</label>
        <input type="text" name="pengajar" class="p-1 border border-gray-400 rounded-md">

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
                <option value="{{ $day->id }}">{{ $day->hari }}</option>
            @endforeach
        </select>
    </div>  
    <div class="flex flex-col space-y-2">
        <label for="start">Waktu mulai</label>
        <input type="time" name="start" class="p-1 border border-gray-400 rounded-md">

        @error('start')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label for="end">Waktu berakhir</label>
        <input type="time" name="end" class="p-1 border border-gray-400 rounded-md">

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
                <option value="{{ $group->id }}">{{ $group->nama }}</option>
            @endforeach
        </select>
    </div>  

    <input type="submit" class="btn-indigo cursor-pointer" value="Buat mata pelajaran">
</form>


@endSection