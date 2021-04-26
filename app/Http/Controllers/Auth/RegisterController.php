<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $redirectTo = '/kelas';

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $code = $this->addNewUser($request);
        
        if($code == 1) {
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
        } else if($code == 1062) {
            return back()->with('duplicatedEmail', 'Email sudah digunakan');
        }
        
    }

    private function addNewUser(Request $request)
    {
        try {
            $user = Account::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->user()->create();
        } catch (QueryException $e) {
            
            $errorCode = $e->errorInfo[1];

            return $errorCode;

            if($errorCode == 1062) {
                return redirect()->route('register')->with('duplicatedEmail', 'Email sudah digunakan');
            }
        }

        return 1;
    }
}
