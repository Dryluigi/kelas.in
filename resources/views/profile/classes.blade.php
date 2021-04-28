@extends('layouts.dashboard')

@section('content')

<div class="flex justify-end pb-4">
    <a href="{{ route('profile.classes.create') }}">
        <div class="btn-indigo">Buat kelas</div>
    </a>
</div>

@if($classes->count())
<div class="overflow-y-auto">
    <div class="flex flex-wrap py-2">
        @foreach($classes as $class)
        <a href="{{ route('classes.show', $class->id) }}">
            <div class="border border-gray-300 mr-4 my-2 rounded-lg h-72 w-72 flex flex-col overflow-hidden">
                <div class="h-20 bg-red-400 flex-none flex flex-col justify-center px-2">
                    <h4 class="text-2xl text-white font-bold leading-none">{{ $class->nama }}</h4>
                </div>
                <div class="flex-auto px-2">
                    {{ $class->deskripsi }}
                </div>
                <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">{{ $class->instansi }}</div>
            </div>
        </a>

        @endforeach
    </div>
</div>
@else
<p class="text-xl font-semibold text-center">Belum ada kelas</p>
@endif

@endSection