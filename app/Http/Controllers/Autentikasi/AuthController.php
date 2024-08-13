<?php

namespace App\Http\Controllers\Autentikasi;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //Login
    public function index()
    {
        return view('auths.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // Jika berhasil login, arahkan ke dashboard sesuai peran
            return redirect()->intended($this->redirectTo());
        }

        toast('Username dan Password Salah!!!', 'warning');
        return redirect('/');
    }

    // Fungsi untuk menentukan rute dashboard berdasarkan peran pengguna
    protected function redirectTo()
    {
        if (Auth::user()->role === 'owner') {
            toast('Berhasil Login!!!', 'success');
            return '/owner/home';
        } else if (Auth::user()->role === 'karyawan') {
            toast('Berhasil Login!!!', 'success');
            return '/karyawan/home';
        }
    }
    // Fungsi untuk logout
    public function logout(Request $request)
    {
        $request->session()->flush(); // Flush all session data
        Auth::logout();
        toast('Berhasil Logout!!!', 'success');
        return redirect('/');
    }

    //Register
    public function showRegisterForm()
    {
        return view('auths.register');
    }

    public function createRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'karyawan',
            ]);
            return redirect('/');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422); // respons kesalahan dengan status kode 422 (Unprocessable Entity)
        }
    }
}
