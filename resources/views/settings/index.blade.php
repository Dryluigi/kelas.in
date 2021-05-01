@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-2xl font-semibold pb-2">List Pengaturan</h3>

<ul class="py-2">
    <a href="{{ route('classes.settings.edit-leader', $class) }}">
        <li class="py-4 hover:bg-gray-200 border border-gray-300 rounded-md">
            <h5 class="px-2">Pindah role ketua kelas</h5>
        </li>
    </a>
</ul>

@endSection