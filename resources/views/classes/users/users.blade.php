@extends('layouts.dashboard_class')

@section('content')

@can('addUser', $class)
<div class="flex pb-4">
    <a href="{{ route('classes.users.invite', $class)}}">
        <div class="btn-green">Tambah anggota</div>
    </a>
</div>
@endCan

@if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
@endif

<h3 class="font-semibold text-xl pb-4">Daftar anggota kelas</h3>

<div class="overflow-y-scroll">
    <table class="border border-gray-600 text-center">
        <thead class="border-b border-gray-600 p-4 bg-indigo-300">
            <th class="p-4">No</th>
            <th class="p-4">Nama</th>
            <th class="p-4">Nomor Induk</th>
            <th class="p-4">Nomor Presensi</th>
            <th class="p-4">Role</th>
            <th class="p-4">Action</th>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td class="p-4">
                    {{ $loop->index + 1}}
                </td>
                <td class="p-4">{{$member->user->nama}}</td>
                <td class="p-4">
                    @if($member->pivot->nomor_induk)
                        {{$member->pivot->nomor_induk}}
                    @else
                        <span class="text-red-500">Belum diset</span>
                    @endif
                </td>
                <td class="p-4">
                    @if($member->pivot->nomor_presensi)
                        {{$member->pivot->nomor_presensi}}
                    @else
                        <span class="text-red-500">Belum diset</span>
                    @endif
                </td>
                <td class="p-4">{{$member->pivot->role}}</td>
                <td class="p-4 flex justify-center space-x-2">
                    @if($member->pivot->account_id !== $user->id)
                        <a href="{{ route('classes.users.edit', [$class, $member]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-600 h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>

                        @can('deleteUser', $class)
                        <form action="{{ route('classes.users.delete', [$class, $member]) }}" method="POST">
                            @csrf
                            <div class="relative w-6 h-6">
                                <input type="submit" class="bg-transparent w-full h-full cursor-pointer" value="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-0 bottom-0 text-red-600 h-full w-full pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </form>
                        @endCan
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endSection