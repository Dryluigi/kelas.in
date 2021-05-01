@php
use Carbon\Carbon;
@endphp

@extends('layouts.dashboard_class')

@section('content')

@can('createCourses', $class)
<div class="flex space-x-2 pb-4">
    <a href="{{ route('classes.courses.create', $class)}}">
        <div class="btn-green">Tambah mata pelajaran</div>
    </a>
    <a href="{{ route('classes.courses.group.create', $class)}}">
        <div class="btn-blue">Tambah kelompok mata pelajaran</div>
    </a>
</div>
@endcan

@if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
@endif

@if($groups->count())
<div class="flex justify-end py-4">
    <form action="{{ route('classes.courses', $class) }}">
        <input type="submit" class="btn-green" value="Update">
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="course_group_id">
            @foreach($groups as $group)
                <option value="{{ $group->id }}" @if(request()->get('course_group_id') == $group->id) selected @endif>{{ $group->nama }}</option>
            @endforeach
        </select>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="day_id">
            @foreach($days as $day)
                <option value="{{ $day->id }}" @if(request()->get('day_id') == $day->id) selected @endif>{{ $day->hari }}</option>
            @endforeach
        </select>
    </form>
</div>
@endif

@if($courses && $courses->count())
<table class="border border-gray-600 text-center w-full">
    <thead class="border-b border-gray-600 p-4 bg-indigo-300">
        <th class="p-4">No</th>
        <th class="p-4">Nama Mata Pelajaran</th>
        <th class="p-4">Pengajar</th>
        <th class="p-4">Mulai</th>
        <th class="p-4">Selesai</th>
        <th class="p-4">Action</th>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td class="p-4">{{ $loop->index + 1}}</td>
            <td class="p-4">{{ $course->nama }}</td>
            <td class="p-4">{{ $course->pengajar }}</td>
            <td class="p-4">{{ Carbon::parse($course->start)->format('H:i') }}</td>
            <td class="p-4">{{ Carbon::parse($course->end)->format('H:i') }}</td>
            <td class="p-4 flex justify-center space-x-2">
                @can('updateCourses', $class)
                <a href="{{ route('classes.courses.edit', [$class, $course]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-600 h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                @endcan

                @can('deleteCourses', $class)
                <form action="{{ route('classes.courses.delete', [$class, $course]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="relative w-6 h-6">
                        <input type="submit" class="bg-transparent w-full h-full cursor-pointer" value="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-0 bottom-0 text-red-600 h-full w-full pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </form>
                @endCan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h4 class="text-center text-2xl font-bold">Belum ada data mata pelajaran</h4>
@endif

@endSection