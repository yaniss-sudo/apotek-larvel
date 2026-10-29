<?php

namespace Database\Seeders;
use App\Models\Staf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Dewi Lestari', 'alamat' => 'Jl. Pemuda No. 12, Medan', 'tanggal_lahir' => '1999-03-14', 'tempat_lahir' => 'Medan',  'no_hp' => '082111222333'],
            ['nama' => 'Rizky Hakim',  'alamat' => 'Jl. Diponegoro No. 7, Medan', 'tanggal_lahir' => '1998-11-02', 'tempat_lahir' => 'Binjai', 'no_hp' => '082444555666'],
        ];

        foreach ($data as $d) {
            Staf::updateOrCreate(['no_hp' => $d['no_hp']], $d);
        }
    }
}
