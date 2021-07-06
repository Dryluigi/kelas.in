@extends('layouts.dashboard_class')

@section('content')

@if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
@endif

<h3 class="text-2xl font-bold">{{ $group->nama }}</h3>

<p class="py-4 tracking-wide">{{ $group->deskripsi }}</p>

<table class="border border-gray-600 text-center w-full">
    <thead class="border-b border-gray-600 p-4 bg-indigo-300">
        <th class="p-4">No</th>
        <th class="p-4">Nama Anggota</th>
        <th class="p-4">Tugas</th>
        <th class="p-4">Hari</th>
        <th class="p-4">Jam</th>
        <th class="p-4">Action</th>
    </thead>
    <tbody>
        @foreach($group->assignedUserChores as $assignedUserChore)
        <tr>
            <td class="p-4">{{ $loop->index + 1 }}</td>
            <td class="p-4">{{ $assignedUserChore->account->user->nama }}</td>
            <td class="p-4">{{ $assignedUserChore->chore->tugas }}</td>
            <td class="p-4">{{ $assignedUserChore->day->hari }}</td>
            <td class="p-4">{{ $assignedUserChore->jam }}</td>
            <td class="p-4 flex justify-center space-x-2">
                {{-- <a href="{{ route('classes.courses.show', [$class, $course])}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </a> --}}
                {{-- @can('updateCourses', $class)
                <a href="{{ route('classes.courses.edit', [$class, $course]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-600 h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                @endcan --}}

                {{-- @can('delete', [$assignedUserChore->chore, $class]) --}}
                <form action="{{ route('classes.chores.user.delete', [$class, $assignedUserChore->chore, $assignedUserChore->account]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="relative w-6 h-6">
                        <input type="submit" class="bg-transparent w-full h-full cursor-pointer" value="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-0 bottom-0 text-red-600 h-full w-full pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </form>
                {{-- @endCan --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endSection