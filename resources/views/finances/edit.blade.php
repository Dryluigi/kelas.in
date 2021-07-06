@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit transaksi</h3>

<form action="{{ route('classes.finances.update', [$class, $finance]) }}" class="flex-col py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="judul">Judul Transaksi</label>
        <input type="text" name="judul" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $finance->judul }}">

        @error('judul')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

    </div>
    <div class="flex flex-col space-y-2">
        <label for="deskripsi">Deskripsi</label>
        <textarea type="text" name="deskripsi" class="p-1 border border-gray-400 rounded-md flex-auto">{{ $finance->deskripsi }}</textarea>
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="jumlah">Nominal</label>
        <div class="flex items-center space-x-2">
            <span>Rp</span>
            <input type="number" name="jumlah" class="p-1 border border-gray-400 rounded-md flex-auto flex-auto" value="{{ $finance->jumlah }}">
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
                <option value="{{ $financeType->id }}" @if($finance->finance_type_id == $financeType->id) selected @endif>{{ $financeType->type }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" class="btn-indigo cursor-pointer" value="Edit Transaksi">
</form>

@endSection