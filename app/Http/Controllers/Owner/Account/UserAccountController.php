<?php

namespace App\Http\Controllers\Owner\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class UserAccountController extends Controller
{
    public function index(Request $request)
    {
        try {
            //code...
            $accountUser = User::where('role', 'user')->latest()->paginate(10);

            if ($request->ajax()) {
                $data = User::where('role', 'karyawan')->latest()->get();

                // Proses pencarian
                if (!empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $data->where(function ($query) use ($searchValue) {
                        $query->where('name', 'like', '%' . $searchValue . '%')
                            ->orWhere('email', 'like', '%' . $searchValue . '%')
                            ->orWhere('role', 'like', '%' . $searchValue . '%');
                    });
                }

                return DataTables::of($data)
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('email', function ($data) {
                        return $data->email;
                    })
                    ->addColumn('role', function ($data) {
                        return $data->role === 'user' ? 'peserta' : $data->role;
                    })
                    ->addColumn('action', function ($data) {
                        return
                            '<a type="button" class="bg-primary py-1 px-2 rounded text-white text-sm rounded mx-1" data-bs-toggle="modal"
                            data-bs-target="#update' . $data->id . '">
                            <i class="fas fa-edit text-white text-sm"></i> Edit
                            </a>
                            <a type="button" class="bg-danger py-1 px-2 rounded text-white text-sm rounded mx-1" data-bs-toggle="modal"
                                data-bs-target="#delete' . $data->id . '">
                                <i class="fas fa-trash fa-xs text-white text-sm opacity-10"></i> Hapus
                            </a>
                            <a type="button" class="bg-danger py-1 px-2 rounded text-white text-sm rounded mx-1" data-bs-toggle="modal"
                                data-bs-target="#updatepassword' . $data->id . '">
                                <i class="fa fa-key fa-xs text-white text-sm opacity-10"></i> Ubah Password
                            </a>';
                    })
                    ->rawColumns(['name', 'email', 'role', 'action'])
                    ->make(true);
            }
            return view('src.pages.owner.account.index', compact('accountUser'));
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/account');
        }
    }


    public function store(Request $request)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|min:8',
                'role' => 'required|string|max:255',
            ]);
            $accountUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
            toast('Berhasil Tambah Data!!!', 'success');
            return redirect('/owner/account');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/account');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //code...
            $accountUser = User::where('id', $id)->first();
            $accountUser->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
            toast('Berhasil Update Data!!!', 'success');
            return redirect('/owner/account');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/account');
        }
    }

    public function destroy($id)
    {
        try {
            //code...
            $accountUser = User::where('id', $id)->first();
            $accountUser->delete();
            toast('Berhasil Delete Data!!!', 'success');
            return redirect('/owner/account');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/account');
        }
    }

    public function indexupdatepassword()
    {

        return view('src.pages.owner.pengaturan.changepassword');
    }
    public function indexupdatepasswordkaryawan()
    {

        return view('src.pages.karyawan.pengaturan.changepassword');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            alert('Sukses', 'Password Berhasil Diganti', 'success');
            return redirect('/owner/changepassword');
        }
        throw ValidationException::withMessages([
            'current_password' => 'your current password does not mact with our record',
        ]);
    }

    public function updatepasswordkaryawan(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            alert('Sukses', 'Password Berhasil Diganti', 'success');
            return redirect('/karyawan/changepassword');
        }
        throw ValidationException::withMessages([
            'current_password' => 'your current password does not mact with our record',
        ]);
    }

    public function ubahpassword(Request $request, $id)
    {
        try {
            //code...
            $request->validate([
                'password' => ['required', 'confirmed'],
            ]);

            $user = User::where('id', $id)->first();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            alert('Sukses', 'Password Berhasil Diganti', 'success');
            return redirect('/owner/account');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/account');
        }
    }
}
