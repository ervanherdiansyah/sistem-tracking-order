<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SmileExport implements FromCollection, WithHeadings
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
            unset($itemArray['nama_pendamping']);
            unset($itemArray['no_pendamping']);
            unset($itemArray['kta']);

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
            'tanggal_lahir',
            'hp',
            'email',
            'alamat',
            'asal_sekolah',
            'kelas',
            'alamat_asal_sekolah',
            'nama_ibu_kandung',
            'nik',
            'no_kk',
            'jurusan1',
            'jurusan2',
        ];
    }
}
