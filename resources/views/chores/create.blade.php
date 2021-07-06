@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Buat tugas piket</h3>

<form action="{{ route('classes.chores', $class) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="tugas">Tugas Piket</label>
        <input type="text" name="tugas" class="p-1 border border-gray-400 rounded-md flex-auto">

        @error('tugas')
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
        <label for="jam">Jam</label>
        <input type="time" name="jam" class="p-1 border border-gray-400 rounded-md">

        @error('jam')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label for="chore_group_id">Kelompok Piket</label>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="chore_group_id">
            @foreach($groups as $group)
                <option value="{{ $group->id }}">{{ $group->nama }}</option>
            @endforeach
        </select>
    </div>  

    <input type="submit" class="btn-indigo cursor-pointer" value="Buat mata pelajaran">
</form>


@endSection