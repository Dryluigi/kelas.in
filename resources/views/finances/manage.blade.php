@extends('layouts.dashboard_class')

@section('content')

@if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
@endif

<table class="border border-gray-600 text-center w-full pt-4">
    <thead class="border-b border-gray-600 p-4 bg-indigo-300">
        <th class="p-4">No</th>
        <th class="p-4">Judul Transaksi</th>
        <th class="p-4">Deskripsi</th>
        <th class="p-4">Jumlah Transaksi</th>
        <th class="p-4">Tanggal Dibuat</th>
        <th class="p-4">Tanggal Diubah</th>
        <th class="p-4">Action</th>
    </thead>
    <tbody>
        @foreach($finances as $finance)
        <tr>
            <td class="p-4">{{ $loop->index + 1 }}</td>
            <td class="p-4">{{ $finance->judul }}</td>
            <td class="p-4">{{ $finance->deskripsi }}</td>
            <td class="p-4">
                @if($finance->finance_type_id == '0')
                    <span class="text-green-500 font-semibold">+Rp{{ $finance->jumlah }}</span>
                @else
                    <span class="text-red-500 font-semibold">-Rp{{ $finance->jumlah }}</span>
                @endif
            </td>
            <td class="p-4">{{ $finance->created_at }}</td>
            <td class="p-4">{{ $finance->updated_at }}</td>
            <td class="p-4 flex justify-center space-x-2">
                <a href="{{ route('classes.finances.edit', [$class, $finance]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-600 h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                <form action="{{ route('classes.finances.delete', [$class, $finance]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="relative w-6 h-6">
                        <input type="submit" class="bg-transparent w-full h-full cursor-pointer" value="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-0 bottom-0 text-red-600 h-full w-full pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </form>
            </td>
        </tr>


        @endforeach
    </tbody>
</table>

{{-- <h4 class="text-center text-2xl font-bold">Belum ada data mata pelajaran</h4> --}}

@endSection