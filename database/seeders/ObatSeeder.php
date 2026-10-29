<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode_obat' => 'OBT001', 'nama_obat' => 'Paracetamol 500 mg', 'stok' => 120, 'tanggal_kadaluarsa' => '2027-12-31'],
            ['kode_obat' => 'OBT002', 'nama_obat' => 'Amoxicillin 500 mg', 'stok' => 60,  'tanggal_kadaluarsa' => '2027-06-30'],
            ['kode_obat' => 'OBT003', 'nama_obat' => 'Vitamin C 1000 mg',  'stok' => 200, 'tanggal_kadaluarsa' => '2028-01-15'],
            ['kode_obat' => 'OBT004', 'nama_obat' => 'Antasida Doen',      'stok' => 15,  'tanggal_kadaluarsa' => '2026-09-01'],
        ];

        foreach ($data as $d) {
            Obat::updateOrCreate(['kode_obat' => $d['kode_obat']], $d);
        }
    }
}
