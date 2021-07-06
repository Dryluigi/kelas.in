@php
use Carbon\Carbon;
use Illuminate\Support\Str;   
@endphp

@extends('layouts.dashboard_class')

@section('content')

<a href="{{ route('classes.posts', $class) }}">
    <span class="inline-block text-sm text-blue-500 hover:underline pb-2">Kembali</span>    
</a>
@if($post)
<div class="">
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

    <h4 class="text-2xl text-indigo-600 font-bold">{{ $post->judul }}</h4>
    <p class="whitespace-pre-line 
              break-words py-4 
              border-b 
              border-indigo-600">{{ $post->isi }}</p>
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

@else

<h4 class="text-2xl font-bold text-center">Tugas tidak ditemukan</h4>

@endif

@endSection