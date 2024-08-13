<?php

namespace App\Http\Controllers\Owner\Tracking;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        try {
            //code...
            if ($request->ajax()) {
                $data = Tracking::latest()->get();

                // Proses pencarian
                if (!empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $data->where(function ($query) use ($searchValue) {
                        $query->where('nama_tracking', 'like', '%' . $searchValue . '%');
                    });
                }

                return DataTables::of($data)
                    ->addColumn('nama_tracking', function ($data) {
                        return $data->nama_tracking;
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
                            </a>';
                    })
                    ->rawColumns(['nama_tracking', 'action'])
                    ->make(true);
            }
            return view('src.pages.owner.tracking.index');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/tracking');
        }
    }


    public function store(Request $request)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'nama_tracking' => 'required|string|max:255',
            ]);
            $tracking = Tracking::create([
                'nama_tracking' => $request->nama_tracking,
            ]);
            toast('Berhasil Tambah Data!!!', 'success');
            return redirect('/owner/tracking');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/tracking');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'nama_tracking' => 'required|string|max:255',
            ]);
            $tracking = Tracking::where('id', $id)->first();
            $tracking->update([
                'nama_tracking' => $request->nama_tracking,
            ]);
            toast('Berhasil Update Data!!!', 'success');
            return redirect('/owner/tracking');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/tracking');
        }
    }

    public function destroy($id)
    {
        try {
            //code...
            $tracking = Tracking::where('id', $id)->first();
            $tracking->delete();
            toast('Berhasil Delete Data!!!', 'success');
            return redirect('/owner/tracking');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/tracking');
        }
    }
}
