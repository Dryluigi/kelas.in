@extends('layouts.dashboard_class')

@section('content')

@can('create', [\App\Models\Finance\Finance::class, $class])
<div class="flex space-x-2 pb-2">
    <a href="{{ route('classes.finances.create', $class) }}">
        <div class="btn-green">Tambah transaksi</div>
    </a>
    <a href="{{ route('classes.finances.manage', $class) }}">
        <div class="btn-blue">Manage transaksi</div>
    </a>
</div>
@endcan

@if(session('success'))
    <div class="bg-green-100 py-2 px-1 rounded-md border border-gray-200">
        <small class="text-sm">{{ session('success') }}</small>
    </div>
@endif

<div class="py-2">
    <small class="text-gray-400 text-sm">Kas kelas:</small>
    <h4 class="font-bold text-xl">Rp{{ $class->cash }}</h4>
</div>

<h3 class="text-xl font-semibold py-2">History Transaksi</h3>

<div class="flex flex-col space-y-2 overflow-y-auto">
    @foreach($finances as $finance)
    <div class="flex items-center border border-gray-300 rounded-lg px-2 py-4">
        <div class="flex-auto">
            <h5 class="font-semibold text-lg">
                {{ $finance->judul }}
            </h5>
            <p>{{ $finance->deskripsi }}</p>
        </div>
        <div class="flex-none">
            @if($finance->finance_type_id == '0')
            <span class="text-2xl font-bold text-green-500">+Rp{{$finance->jumlah}}</span>
            @else
            <span class="text-2xl font-bold text-red-500">-Rp{{$finance->jumlah}}</span>
            @endif
        </div>
    </div>
    @endforeach
</div>


@endSection