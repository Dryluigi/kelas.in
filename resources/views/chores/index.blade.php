@php
use Carbon\Carbon;
@endphp

@extends('layouts.dashboard_class')

@section('content')

@can('create', [\App\Models\Chore\Chore::class, $class])
<div class="flex space-x-2 pb-4">
    <a href="{{ route('classes.chores.create', $class)}}">
        <div class="btn-green">Tambah tugas piket</div>
    </a>
    <a href="{{ route('classes.chore-groups.create', $class)}}">
        <div class="btn-blue">Tambah kelompok piket</div>
    </a>
    <a href="{{ route('classes.chores.assign-user', $class)}}">
        <div class="btn-blue">Assign tugas piket ke anggota</div>
    </a>
    <a href="{{ route('classes.chore-groups', $class)}}">
        <div class="btn-blue">Manage tugas piket</div>
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
    <form action="{{ route('classes.chores', $class) }}">
        <input type="submit" class="btn-green" value="Update">
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="chore_group_id">
            @foreach($groups as $group)
                <option value="{{ $group->id }}" @if(request()->get('chore_group_id') == $group->id) selected @endif>{{ $group->nama }}</option>
            @endforeach
        </select>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="day_id">
            @foreach($days as $day)
                <option value="{{ $day->id }}" @if(request()->get('day_id') == $day->id) selected @endif>{{ $day->hari }}</option>
            @endforeach
        </select>
    </form>
</div>

<table class="border border-gray-600 text-center w-full">
    <thead class="border-b border-gray-600 p-4 bg-indigo-300">
        <th class="p-4">No</th>
        <th class="p-4">Nama</th>
        <th class="p-4">Tugas</th>
        <th class="p-4">Hari</th>
        <th class="p-4">Jam</th>
    </thead>
    <tbody>
        @foreach($assignedUserChores as $assignedUserChore)
        <tr>
            <td class="p-4">{{ $loop->index + 1 }}</td>
            <td class="p-4">{{ $assignedUserChore->account->user->nama }}</td>
            <td class="p-4">{{ $assignedUserChore->chore->tugas }}</td>
            <td class="p-4">{{ $assignedUserChore->day->hari }}</td>
            <td class="p-4">{{ Carbon::parse($assignedUserChore->jam)->format('H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
<h4 class="text-center text-2xl font-bold">Belum ada data piket</h4>
@endif
@endSection