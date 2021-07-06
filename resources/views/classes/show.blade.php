@php
use Carbon\Carbon;   
use Illuminate\Support\Str;
@endphp

@extends('layouts.dashboard_class')

@section('content')

<div class="flex space-x-2 pb-2">
    <a class="w-1/3" href="{{ route('classes.users', $class) }}">
        <div class="border border-gray-300 rounded-md p-2 flex items-center">
            <div class="flex-auto">
                <h3 class="text-gray-500 text-sm">Anggota Kelas</h3>
                <span class="text-3xl font-bold">{{ $members }}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>    
        </div>
    </a>
    <a class="w-1/3" href="{{ route('classes.assignments', $class) }}">
        <div class="border border-gray-300 rounded-md p-2 flex items-center">
            <div class="flex-auto">
                <h3 class="text-gray-500 text-sm">Tugas aktif</h3>
                <span class="text-3xl font-bold">{{ $assignments }}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>    
        </div>
    </a>
    <a class="w-1/3" href="{{ route('classes.finances', $class) }}">
        <div class="border border-gray-300 rounded-md p-2 flex items-center">
            <div class="flex-auto">
                <h3 class="text-gray-500 text-sm">Kas Kelas</h3>
                <span class="text-3xl font-bold">Rp{{ $class->cash }}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>    
        </div>
    </a>
</div>

<div class="flex flex-col overflow-y-auto">
    <h3 class="text-lg font-semibold">Hari ini</h3>

    <div class="flex space-x-2 py-2">
        <div class="w-3/4">
            <table class="border border-gray-600 text-center w-full">
                <thead class="border-b border-gray-600 p-4 bg-indigo-300">
                    <th class="p-4">No</th>
                    <th class="p-4">Nama Mata Pelajaran</th>
                    <th class="p-4">Pengajar</th>
                    <th class="p-4">Jam</th>
                </thead>
                <tbody>
                    @if($courses->count())
                        @foreach($courses as $course)
                        <tr>
                            <td class="p-4">{{ $loop->index + 1 }}</td>
                            <td class="p-4">{{ $course->nama }}</td>
                            <td class="p-4">{{ $course->pengajar }}</td>
                            <td class="p-4">{{ Carbon::parse($course->start)->format('H:i') . " - " . Carbon::parse($course->end)->format('H:i') }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="p-4" colspan="4">Tidak ada pelajaran</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="w-1/4">
            <table class="border border-gray-600 text-center w-full">
                <thead class="border-b border-gray-600 p-4 bg-indigo-300">
                    <th class="p-4">Tugas Piket</th>
                </thead>
                <tbody>
                    @if($chores->count())
                    @foreach($chores as $chore)
                    <tr>
                        <td class="p-4">{{ $chore->chore->tugas }} - {{ $chore->jam }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="p-4">Tidak ada tugas</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @if($posts->count())
        <h3 class="text-lg font-semibold">Post terbaru</h3>

        @foreach($posts as $post)
        <div class="border-b border-gray-300 pb-2">
            <a href="{{ route('classes.posts.show', [$class, $post]) }}">
                <h4 class="text-2xl text-indigo-600 font-bold hover:underline">{{ $post->judul }}</h4>
            </a>
            <p class="whitespace-pre-line 
                    break-words py-4 
                    border-b 
                    border-indigo-600">{{ Str::words($post->isi, 30) }} @if(str_word_count($post->isi) > 30) <span><a href="{{ route('classes.posts.show', [$class, $post]) }}" class="text-blue-500 hover:underline">Selengkapnya</a></span> @endif
        </p>
            <div class="flex justify-between py-2">
                <small class="text-sm">Dibuat oleh: 
                    <span class="font-bold">
                        @if($post->user != null)
                            {{ $post->user->user->nama }}
                        @else
                            {{ "unknown" }}
                        @endif
                    </span>
                </small>
                <small class="text-sm">Tanggal dibuat: <span class="font-bold">{{ Carbon::parse($post->created_at)->format('d F Y | H:i') }}</span></small>
            </div>
        </div>
        @endforeach
    @endif
</div>


@endSection