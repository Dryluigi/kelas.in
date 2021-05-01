@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-2xl font-semibold">Pindah role ketua kelas</h3>

<form action="{{ route('classes.settings.update-leader', $class) }}" method="POST" class="py-4">
    @method('PUT')
    @csrf
    <div class="space-y-2">
        <div class="flex flex-col space-y-2">
            <label for="email">Pilih email anggota yang ingin dijadikan Ketua kelas baru</label>
            <select class="p-1 border border-gray-400 rounded-md" name="email">
                @foreach($members as $member)
                    <option value="{{ $member->email }}">{{ $member->email }}</option>
                @endforeach
            </select>
        </div>
        
        <input type="submit" class="btn-indigo" value="Ganti">
    </div>
</form>

@endSection