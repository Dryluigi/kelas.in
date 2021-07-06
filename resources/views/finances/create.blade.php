@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Tambah transaksi</h3>

<form action="{{ route('classes.finances', $class) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="judul">Judul Transaksi</label>
        <input type="text" name="judul" class="p-1 border border-gray-400 rounded-md flex-auto">

        @error('judul')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>
    <div class="flex flex-col space-y-2">
        <label for="deskripsi">Deskripsi</label>
        <textarea type="text" name="deskripsi" class="p-1 border border-gray-400 rounded-md flex-auto"></textarea>
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="jumlah">Nominal</label>
        <div class="flex items-center space-x-2">
            <span>Rp</span>
            <input type="number" name="jumlah" class="p-1 border border-gray-400 rounded-md flex-auto flex-auto">
        </div>

        @error('jumlah')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>
    <div class="flex flex-col space-y-2">
        <label for="finance_type_id">Jenis Transaksi</label>
        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="finance_type_id">
            @foreach($financeTypes as $financeType)
                <option value="{{ $financeType->id }}">{{ $financeType->type }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" class="btn-indigo cursor-pointer" value="Buat Transaksi">
</form>

@endSection