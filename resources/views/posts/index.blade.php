@php
use Carbon\Carbon;   
use Illuminate\Support\Str;
@endphp

@extends('layouts.dashboard_class')

@section('content')

<div class="flex pb-4">
    <a href="{{ route('classes.posts.create', $class)}}">
        <div class="btn-green">Buat post</div>
    </a>
</div>

<div class="p-4 overflow-y-auto space-y-4">
    @if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
    @endif

    @foreach($posts as $post)
        
            <div class="@if(!$loop->last) border-b border-gray-300 @endif pb-2">
                <div class="flex space-x-4">
                    @can('delete', $post)
                    
                    <form action="{{ route('classes.posts.delete', [$class, $post]) }}, " method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="text-xs text-red-500 bg-transparent cursor-pointer hover:underline" value="Hapus">
                    </form>
                    
                    @endcan

                    @can('edit', $post)
                    <a href="{{ route('classes.posts.edit', [$class, $post]) }}">
                        <small class="text-xs text-yellow-500 hover:underline">Edit</small>
                    </a>
                    @endcan
                </div>

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
</div>

@endSection