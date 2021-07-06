<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kelas;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('profile.index')->with(['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:255',
            'foto_profil' => 'image',
        ]);
        
        $updatedData = $request->only(
            'nama', 
            'alamat', 
            'tanggal_lahir', 
            'nomor_telepon'
        );

        if($request->foto_profil) {
            $newFileName = $this->saveFotoProfil($request);
            $updatedData['foto_profil'] = $newFileName;
        }

        $isUpdated = auth()->user()->user()->update($updatedData);

        if($isUpdated) {
            return back()->with('success', 'Profil berhasil diperbarui.');
        }
    }

    public function classes()
    {
        $classes = Kelas::findByAccountId(auth()->user()->id);

        return view('profile.classes')->with([
            'user' => auth()->user(),
            'classes' => $classes
        ]);
    }

    public function classesCreate()
    {
        return view('profile.classes.create')->with([
            'user' => auth()->user(),
        ]);
    }

    public function assignments()
    {
        dd(auth()->user()->assignments());
    }

    private function saveFotoProfil(Request $request) {
        $extension = $request->foto_profil->getClientOriginalExtension();
        $newFileName = auth()->user()->id . "." . $extension;

        Storage::disk('profile_images')->put($newFileName, $request->foto_profil->get());

        return $newFileName;
    }
}
