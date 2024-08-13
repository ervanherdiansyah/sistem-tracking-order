<?php

namespace App\Http\Controllers\Owner\Home;

use App\Http\Controllers\Controller;
use App\Models\Data\Guru;
use App\Models\Data\Siswa;
use App\Models\Form;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\Pendaftaran\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        try {
            //code...
            // Data Chart Line
            $orderPertahun = DB::table('orders')
                ->selectRaw('YEAR(tanggal_order) as tahun, COUNT(*) as total_order')
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get();

            $labels = $orderPertahun->pluck('tahun');
            $values = $orderPertahun->pluck('total_order');

            // Debug labels dan data untuk memastikan
            // dd($labels);

            $jumlahOrder = Order::count();
            $jumlahUser = User::where('role', 'karyawan')->count();
            $orderDeadline = Order::orderBy('deadline', 'asc')->limit(4)->get();
            $orderKeuntungan = Order::orderBy('keuntungan', 'desc')->limit(4)->get();

            return view('src.pages.owner.home.index', compact('jumlahOrder', 'jumlahUser', 'labels', 'values', 'orderDeadline', 'orderKeuntungan', 'orderPertahun'));
        } catch (\Throwable $th) {
            //throw $th;
            toast($th->getMessage(), 'warning');
            return redirect('/owner/home');
        }
    }
}
