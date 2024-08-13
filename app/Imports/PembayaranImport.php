<?php

namespace App\Imports;

use App\Models\Data\Guru;
use App\Models\Form;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PembayaranImport implements ToModel, WithHeadingRow
{


    public function model(array $row)
    {
        $tanggal_lahir = null;
        if (isset($row['tanggal_lahir'])) {
            $tanggal_lahir = $row['tanggal_lahir'];
            // Validasi apakah tanggal lahir adalah format yang benar, misalnya YYYY-MM-DD
            if (!strtotime($tanggal_lahir)) {
                // Tanggal lahir tidak valid, beri nilai default atau tindakan lainnya
                $tanggal_lahir = null;
            }
        }

        return new Form([
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => $row['agama'],
            'asal_sekolah' => $row['asal_sekolah'],
            'alamat_asal_sekolah' => $row['alamat_asal_sekolah'],
            'kelas' => $row['kelas'],
            'jurusan' => $row['jurusan'],
            'email' => $row['email'],
            'hp' => $row['hp'],
            'instagram' => $row['instagram'],
            'alamat' => $row['alamat'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    public function startRow(): int
    {
        return 2; // Mulai dari baris kedua karena baris pertama adalah header
    }
}
