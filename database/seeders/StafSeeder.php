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
            ['nama' => 'Hidayatussalikin', 'alamat' => 'Jl. Pemuda No. 12, Medan', 'tanggal_lahir' => '2001-03-14', 'tempat_lahir' => 'Kalimantan',  'no_hp' => '082111222353'],
            ['nama' => 'Yanissullah',  'alamat' => 'Jl. Diponegoro No. 7, Medan', 'tanggal_lahir' => '2002-11-02', 'tempat_lahir' => 'Kalimantan', 'no_hp' => '082444555666'],
            ['nama' => 'Nadiatul hikmah', 'alamat' => 'Jl. Anggrek No. 12, Singapura', 'tanggal_lahir' => '2003-03-14', 'tempat_lahir' => 'Medan',  'no_hp' => '082111228333'],
            ['nama' => 'Shaina Aulia Putri', 'alamat' => 'Jl. Sumpah Pemuda No. 12, Singapura', 'tanggal_lahir' => '2004-04-14', 'tempat_lahir' => 'Medan',  'no_hp' => '082111222343'],
        ];

        foreach ($data as $d) {
            Staf::updateOrCreate(['no_hp' => $d['no_hp']], $d);
        }
    }
}
