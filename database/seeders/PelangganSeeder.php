<?php

namespace Database\Seeders;
use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Budi Santoso', 'alamat' => 'Jl. Merdeka No. 1, Medan', 'no_hp' => '081234567890'],
            ['nama' => 'Siti Aminah',  'alamat' => 'Jl. Sudirman No. 5, Medan', 'no_hp' => '081298765432'],
            ['nama' => 'Andi Pratama', 'alamat' => 'Jl. Gatot Subroto No. 9, Medan', 'no_hp' => '085212345678'],
        ];

        foreach ($data as $d) {
            Pelanggan::updateOrCreate(['no_hp' => $d['no_hp']], $d);
        }
    }
}
