@php
use Carbon\Carbon;
@endphp

@extends('layouts.dashboard_class')

@section('content')

@can('create', [\App\Models\Assignment::class, $class])
<div class="flex space-x-2 pb-4">
    <a href="{{ route('classes.assignments.create', $class)}}">
        <div class="btn-green">Tambah tugas</div>
    </a>
    @if($activeCourseGroup)
    <a href="{{ route('classes.course-groups.show', [$class, $activeCourseGroup])}}">
        <div class="btn-blue">Manage tugas</div>
    </a>
    @endif
</div>
@endcan

@if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
@endif

@if($activeAssignments->count())
<div class="flex space-x-4 overflow-y-hidden">
    <div class="flex flex-col flex-auto">
        <h3 class="text-xl font-bold">Tugas Aktif</h3>
        <div class="overflow-y-auto">
            @foreach($activeAssignments as $activeAssignment)

            <div class="pt-4">
                <h4 class="text-2xl text-indigo-600 font-bold">{{ $activeAssignment->judul }}</h4>
                <p class="whitespace-pre-line 
                        break-words py-4 
                        border-b 
                        border-indigo-600">{{ $activeAssignment->deskripsi }}</p>
                <div class="flex justify-between py-2">
                    <small class="text-sm font-bold">{{ $activeAssignment->course->nama }}</small>
                    <small class="text-sm">Deadline: <span class="font-bold">{{ Carbon::parse($activeAssignment->deadline)->format('d F Y | H:i') }}</span></small>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <div class="flex flex-col flex-auto">
        <h3 class="text-xl font-bold">Tugas Lampau</h3>
        <div class="overflow-y-auto">
            @foreach($oldAssignments as $oldAssignment)

            <div class="pt-4">
                <h4 class="text-2xl text-indigo-600 font-bold">{{ $oldAssignment->judul }}</h4>
                <p class="whitespace-pre-line 
                        break-words py-4 
                        border-b 
                        border-indigo-600">{{ $oldAssignment->deskripsi }}</p>
                <div class="flex justify-between py-2">
                    <small class="text-sm font-bold">{{ $oldAssignment->course->nama }}</small>
                    <small class="text-sm">Deadline: <span class="font-bold">{{ Carbon::parse($oldAssignment->deadline)->format('d F Y | H:i') }}</span></small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<h4 class="text-2xl font-bold text-center">Belum ada data tugas</h4>
@endif

@endSection