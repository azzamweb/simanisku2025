<?php

namespace App\Imports;

use App\Models\Rekap;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RekapImport implements ToModel, WithStartRow
{
    private $startRow = 7; // Sesuaikan baris mulai impor

    /**
     * @param int $row
     * @return int
     */
    public function startRow(): int
    {
        return $this->startRow;
    }
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rekap([
            // 'nomor_lhp_tanggal' => $row[1],
            // 'rincian_temuan' => $row[2], 
            // 'jumlah_temuan' => $row[3], 
        ]);
    }
}
