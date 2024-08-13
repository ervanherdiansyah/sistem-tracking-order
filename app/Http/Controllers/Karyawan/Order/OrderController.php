<?php

namespace App\Http\Controllers\Karyawan\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            //code...
            $statusTracking = Tracking::get();
            if ($request->ajax()) {
                $data = Order::query();

                // Proses pencarian
                if (!empty($request->search['value'])) {
                    $searchValue = $request->search['value'];
                    $data->where(function ($query) use ($searchValue) {
                        $query->where('nama_order', 'like', '%' . $searchValue . '%')
                            ->orWhere('tracking_id', 'like', '%' . $searchValue . '%')
                            ->orWhere('user_id', 'like', '%' . $searchValue . '%')
                            ->orWhere('tanggal_order', 'like', '%' . $searchValue . '%')
                            ->orWhere('gamabar_order', 'like', '%' . $searchValue . '%')
                            ->orWhere('status_order', 'like', '%' . $searchValue . '%')
                            ->orWhere('gambar_status', 'like', '%' . $searchValue . '%')
                            ->orWhere('kode_warna', 'like', '%' . $searchValue . '%')
                            ->orWhere('deadline', 'like', '%' . $searchValue . '%')
                            ->orWhere('keuntungan', 'like', '%' . $searchValue . '%')
                            ->orWhere('item_belanja', 'like', '%' . $searchValue . '%')
                            ->orWhere('sisa_bahan', 'like', '%' . $searchValue . '%')
                            ->orWhere('log_update', 'like', '%' . $searchValue . '%');
                    });
                }

                // Proses pengurutan
                if ($request->has('order')) {
                    $order = $request->order[0];
                    $columns = [
                        '0' => 'nama_order',
                        '1' => 'gamabar_order',
                        '2' => 'kode_warna',
                        '3' => 'tanggal_order',
                        '4' => 'deadline',
                        '5' => 'tracking_id',
                        '6' => 'gambar_status',
                        '7' => 'keuntungan',
                        '8' => 'item_belanja',
                        '9' => 'sisa_bahan',
                        '10' => 'log_update'
                    ];
                    $column = $columns[$order['column']];
                    $direction = $order['dir'];

                    if (in_array($column, ['tanggal_order', 'deadline'])) {
                        // Sorting date columns (assuming 'YYYY-MM-DD' format in the database)
                        $data->orderBy($column, $direction);
                    } else {
                        // Default sorting for text and numeric columns
                        $data->orderBy($column, $direction);
                    }
                }

                $no = 1;
                return DataTables::of($data)
                    ->addColumn('no', function ($data) use (&$no) {
                        return  $no++;
                    })
                    ->addColumn('nama_order', function ($data) {
                        return  $data->nama_order ?? '-';
                    })
                    ->addColumn('gamabar_order', function ($data) {
                        if ($data->gamabar_order) {
                            $imageUrl = asset('storage/' . $data->gamabar_order);
                            return '<a href="' . $imageUrl . '" data-lightbox="gambar-order" data-title="Gambar Order">
                                        <img src="' . $imageUrl . '" alt="Gambar Order" style="max-width: 100px;">
                                    </a>';
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('kode_warna', function ($data) {
                        return  $data->kode_warna ?? '-';
                    })
                    ->addColumn('tanggal_order', function ($data) {
                        return  Carbon::parse($data->tanggal_order)->locale('id')->isoFormat('D MMMM YYYY') ?? '-';
                    })
                    ->addColumn('deadline', function ($data) {
                        return  Carbon::parse($data->deadline)->locale('id')->isoFormat('D MMMM YYYY') ?? '-';
                    })
                    ->addColumn('keuntungan', function ($data) {
                        return 'Rp. ' . number_format($data->keuntungan);
                    })
                    ->addColumn('tracking_id', function ($data) {
                        return $data->tracking_id;
                    })
                    ->addColumn('gambar_status', function ($data) {
                        if ($data->gambar_status) {
                            $imageUrl = asset('storage/' . $data->gambar_status);
                            return '<a href="' . $imageUrl . '" data-lightbox="gambar-status" data-title="Gambar Status">
                                        <img src="' . $imageUrl . '" alt="Gambar Status" style="max-width: 100px;">
                                    </a>';
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('item_belanja', function ($data) {
                        return strip_tags($data->item_belanja) ?: '-';
                    })
                    ->addColumn('sisa_bahan', function ($data) {
                        return strip_tags($data->sisa_bahan) ?: '-';
                    })
                    ->addColumn('log_update', function ($data) {
                        return $data->log_update ?? '-';
                    })
                    ->addColumn('status_order', function ($data) {
                        if ($data->status_order) {
                            return '<a type="button" class="bg-primary py-1 px-4 rounded-pill text-sm text-white" data-bs-toggle="modal" data-bs-target="#updateStatus' . $data->id . '">'
                                . $data->status_order .
                                '</a>';
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('action', function ($data) {
                        return '<a type="button" class="bg-primary py-1 px-2 rounded d-block text-white text-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#update' . $data->id . '">
                                <i class="fas fa-edit text-white opacity-10"></i> Edit
                            </a>
                            <a type="button" class="bg-success py-1 px-2 rounded d-block text-white text-sm rounded-pill my-1" data-bs-toggle="modal" data-bs-target="#view' . $data->id . '">
                                <i class="fa fa-eye" text-white aria-hidden="true"></i> Lihat
                            </a>  
                            <a type="button" class="bg-danger py-1 px-2 rounded d-block text-white text-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#delete' . $data->id . '">
                                <i class="fas fa-trash fa-xs text-white text-sm opacity-10"></i> Hapus
                            </a>';
                    })
                    ->rawColumns(['tracking_id', 'gamabar_order', 'status_order', 'gambar_status', 'action'])
                    ->make(true);
            }

            return view('src.pages.karyawan.order.index', compact('statusTracking'));
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/karyawan/order');
        }
    }



    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'tracking_id' => 'required|string|max:255',
                'nama_order' => 'required|string|max:255',
                'tanggal_order' => 'required|date',
                'deadline' => 'required|date',
                'gamabar_order' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                // 'status' => 'required|string|max:255',
                'gambar_status' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                // 'log_update' => 'required|string|max:255',
            ]);
            $file_name = null;
            if ($request->hasFile('gamabar_order')) {
                $file_name = $request->gamabar_order->getClientOriginalName();
                $namaGambar = str_replace(' ', '_', $file_name);
                $image = $request->gamabar_order->storeAs('public/gamabar_order', $namaGambar);
            }
            $file_name2 = null;
            if ($request->hasFile('gambar_status')) {
                $file_name2 = $request->gambar_status->getClientOriginalName();
                $namaGambar2 = str_replace(' ', '_', $file_name2);
                $image = $request->gambar_status->storeAs('public/gambar_status', $namaGambar2);
            }
            $statusOrder = Tracking::where('id', $request->tracking_id)->first();
            $data = Order::create([
                'nama_order' => $request->nama_order,
                'tanggal_order' => $request->tanggal_order,
                'tracking_id' => $request->tracking_id,
                'kode_warna' => $request->kode_warna,
                'deadline' => $request->deadline,
                'keuntungan' => $request->keuntungan,
                'item_belanja' => $request->item_belanja,
                'sisa_bahan' => $request->sisa_bahan,
                'status_order' => $statusOrder->nama_tracking,
                'log_update' => 'Created By ' . Auth::user()->name,
                'gamabar_order' => $file_name ? 'gamabar_order/' . $namaGambar : null,
                'gambar_status' => $file_name2 ? 'gambar_status/' . $namaGambar2 : null,

            ]);
            toast('Berhasil Tambah Data!!!', 'success');
            return redirect('/karyawan/order');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/karyawan/order');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'tracking_id' => 'required|string|max:255',
                'nama_order' => 'required|string|max:255',
                'tanggal_order' => 'required|date',
                'deadline' => 'required|date',
            ]);
            // Get the input value
            $keuntungan = $request->input('keuntungan');

            // Clean the input value (Remove 'Rp.' and commas)
            $keuntunganCleaned = str_replace(['Rp.', ','], '', $keuntungan);

            // Convert the cleaned value to integer
            $keuntunganInteger = (int) $keuntunganCleaned;
            $data = Order::where('id', $id)->first();

            if (Request()->hasFile('gamabar_order') && $request->file('gamabar_order')->isValid()) {
                // Hapus gamabar_order lama jika ada
                // if (!empty($data->gamabar_order) && Storage::disk('public')->exists($data->gamabar_order)) {
                //     Storage::disk('public')->delete($data->gamabar_order);
                // }

                // Proses gamabar_order baru
                $file_name1 = $request->file('gamabar_order')->getClientOriginalName();
                $namaGambar1 = str_replace(' ', '_', $file_name1);
                $image1 = $request->file('gamabar_order')->storeAs('public/gamabar_order', $namaGambar1);
            }

            if (Request()->hasFile('gambar_status') && $request->file('gambar_status')->isValid()) {
                // Hapus gambar_status lama jika ada
                // if (!empty($data->gambar_status) && Storage::disk('public')->exists($data->gambar_status)) {
                //     Storage::disk('public')->delete($data->gambar_status);
                // }

                // Proses gambar_status baru
                $file_name2 = $request->file('gambar_status')->getClientOriginalName();
                $namaGambar2 = str_replace(' ', '_', $file_name2);
                $image2 = $request->file('gambar_status')->storeAs('public/gambar_status', $namaGambar2);
            }
            $statusOrder = Tracking::where('id', $request->tracking_id)->first();
            $data->update([
                'nama_order' => $request->nama_order,
                'tanggal_order' => $request->tanggal_order,
                'tracking_id' => $request->tracking_id,
                'kode_warna' => $request->kode_warna,
                'deadline' => $request->deadline,
                'keuntungan' => $keuntunganInteger,
                'item_belanja' => $request->item_belanja,
                'sisa_bahan' => $request->sisa_bahan,
                'status_order' => $statusOrder->nama_tracking,
                'log_update' => 'Updated By ' . Auth::user()->name,
                'gamabar_order' => isset($image1) ? 'gamabar_order/' . $namaGambar1 : $data->gamabar_order,
                'gambar_status' => isset($image2) ? 'gambar_status/' . $namaGambar2 : $data->gambar_status,
            ]);

            toast('Berhasil Update Data!!!', 'success');
            return redirect('/karyawan/order');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/karyawan/order');
        }
    }

    public function destroy($id)
    {
        try {
            //code...
            $data = Order::where('id', $id)->first();
            $data->delete();
            toast('Berhasil Delete Data!!!', 'success');
            return redirect('/karyawan/order');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/karyawan/order');
        }
    }

    public function updateStatusOrder(Request $request, $id)
    {
        try {
            //code...
            $data = Order::where('id', $id)->first();
            $statusOrder = Tracking::where('id', $request->tracking_id)->first();
            $data->update([
                'tracking_id' => $request->tracking_id,
                'status_order' => $statusOrder->nama_tracking,
                'log_update' => 'Updated By ' . Auth::user()->name,
            ]);
            toast('Berhasil Update Status Order Data!!!', 'success');
            return redirect('/karyawan/order');
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/karyawan/order');
        }
    }
}
