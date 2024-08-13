<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PembayaranExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $guru = Pembayaran::with('provinsi', 'kota')->where('status', 'Paid')->get();
        $data = $guru->map(function ($item, $index) {
            // Hapus kolom 'id' dari hasil toArray()
            $itemArray = $item->toArray();
            unset($itemArray['id']);
            unset($itemArray['created_at']);
            unset($itemArray['updated_at']);
            unset($itemArray['provinsi_id']);
            unset($itemArray['kota_id']);
            unset($itemArray['user_id']);
            unset($itemArray['tanggal_pembayaran']);
            unset($itemArray['kecamatan']);
            unset($itemArray['kelurahan']);
            unset($itemArray['kode_pos']);
            unset($itemArray['courier']);
            unset($itemArray['shipping_price']);
            unset($itemArray['shipping_status']);
            unset($itemArray['shipping_paket']);
            unset($itemArray['no_wa']);
            $itemArray['provinsi'] = $item->provinsi->name ?? '';;
            $itemArray['kota'] = $item->kota->name ?? '';;
            $itemArray['kecamatan'] = $item->kecamatan;
            $itemArray['kelurahan'] = $item->kelurahan;
            $itemArray['kode_pos'] = $item->kode_pos;
            $itemArray['courier'] = $item->courier;
            $itemArray['shipping_price'] = $item->shipping_price;
            $itemArray['shipping_status'] = $item->shipping_status;
            $itemArray['shipping_paket'] = $item->shipping_paket;
            $itemArray['no_wa'] = $item->no_wa;
            $itemArray['tanggal_pembayaran'] = $item->updated_at;

            // Menggabungkan nomor urutan dan data siswa
            return array_merge([$index + 1], $itemArray);
        });

        return $data;
    }
    public function headings(): array
    {
        // Definisi header yang ingin Anda tambahkan
        return [
            'no',
            'jumlah_pembayaran',
            'status',
            'jenis_order',
            'nama_depan',
            'nama_belakang',
            'alamat',
            'provinsi',
            'kota',
            'kecamatan',
            'kelurahan',
            'kode_pos',
            'courier',
            'shipping_price',
            'shipping_status',
            'shipping_paket',
            'no_wa',
            'tanggal_pembayaran'
        ];
    }
}
