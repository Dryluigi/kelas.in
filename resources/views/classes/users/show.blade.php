@extends('layouts.dashboard_class')

@section('content')

<h3 class="font-semibold text-xl pb-4">Data anggota</h3>

@if($userClass == null)
<h4 class="text-center text-2xl font-bold">Data anggota tidak ditemukan</h4>
@else
<table>
    <tbody>
        <tr>
            <td class="p-4 w-64">Nama</td>
            <td class="p-4">{{ $userClass->user->nama }}</td>
        </tr>
        <tr>
            <td class="p-4 w-64">Email</td>
            <td class="p-4">{{ $userClass->email }}</td>
        </tr>
        <tr>
            <td class="p-4 w-64">Alamat</td>
            <td class="p-4">{{ $userClass->user->alamat }}</td>
        </tr>
        <tr>
            <td class="p-4 w-64">Nomor Telepon</td>
            <td class="p-4">{{ $userClass->user->nomor_telepon }}</td>
        </tr>
        <tr>
            <td class="p-4 w-64">Nomor Induk Kelas</td>
            <td class="p-4">
                @if($userClass->pivot->nomor_induk)
                    {{ $userClass->pivot->nomor_induk }}
                @else
                    <span class="text-red-500">Belum diset</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="p-4 w-64">Nomor Presensi Kelas</td>
            <td class="p-4">
                @if($userClass->pivot->nomor_presensi)
                    {{ $userClass->pivot->nomor_presensi }}
                @else
                    <span class="text-red-500">Belum diset</span>
                @endif
            </td>
        </tr>
    </tbody>
</table>

@if($userClass->user->id == $user->id)
<a href="{{ route('classes.profile.edit', $class)}}">
    <div class="btn-green inline-block">Edit profil</div>
</a>
@endif

@endif

@endSection