<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class FormExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $guru = Form::all();
        $data = $guru->map(function ($item, $index) {
            // Hapus kolom 'id' dari hasil toArray()
            $itemArray = $item->toArray();
            unset($itemArray['id']);
            unset($itemArray['created_at']);
            unset($itemArray['updated_at']);
            unset($itemArray['user_id']);
            unset($itemArray['provinsi']);
            unset($itemArray['kota_kabupaten']);
            unset($itemArray['kecamatan']);
            unset($itemArray['kelurahan	']);
            unset($itemArray['foto']);

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
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'asal_sekolah',
            'alamat_asal_sekolah',
            'kelas',
            'jurusan',
            'email',
            'hp',
            'instagram',
            'alamat',
        ];
    }
}
