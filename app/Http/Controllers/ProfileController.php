<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        ]);
        
        $isUpdated = auth()->user()->user()->update(
            $request->only(
                'nama', 
                'alamat', 
                'tanggal_lahir', 
                'nomor_telepon')
        );

        if($isUpdated) {
            return back()->with('success', 'Profil berhasil diperbarui.');
        }
    }

    public function class()
    {
        $classes = Kelas::findByAccountId(auth()->user()->id);

        return view('profile.classes')->with([
            'user' => auth()->user(),
            'classes' => $classes]);
    }

    public function classesCreate()
    {
        return view('profile.classes.create')->with([
            'user' => auth()->user(),
        ]);
    }
}
