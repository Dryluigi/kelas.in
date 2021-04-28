@extends('layouts.dashboard_class')

@section('content')

<h3 class="text-xl font-bold">Edit anggota</h3>

<form action="{{ route('classes.users.update', [$class, $targetUser]) }}" class="py-4 space-y-4 w-1/2" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="email">Email</label>
        <input type="text" name="email" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $targetUser->email }}" disabled>

        @error('email')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError

        @if(session('fail'))
            <small class="text-red-500 text-sm">
                {{ session('fail') }}
            </small>
        @endif      

    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nomor_induk">Nomor Induk</label>
        <input type="text" name="nomor_induk" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $class->pivot->nomor_induk }}">

        @error('nomor_induk')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label class="flex-none" for="nomor_presensi">Nomor Presensi</label>
        <input type="text" name="nomor_presensi" class="p-1 border border-gray-400 rounded-md flex-auto" value="{{ $class->pivot->nomor_presensi }}">

        @error('nomor_induk')
        <small class="text-red-500 text-sm">
            {{ $message }}
        </small>
        @endError
        
    </div>
    <div class="flex flex-col space-y-2">
        <label for="role_id">Role</label>

        <select class="p-1 border border-gray-400 rounded-md flex-auto" name="role_id">
            @foreach($roles as $roleData)
                @if($roleData->id != '0')
                <option value="{{ $roleData->id }}">{{ $roleData->role }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <input type="submit" class="btn-indigo cursor-pointer" value="Update data">
</form>


@endSection