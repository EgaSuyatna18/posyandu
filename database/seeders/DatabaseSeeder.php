<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123')
        ]);

        // \App\Models\Ibu::factory()->create([
        //     'nik' => '123',
        //     'nama_istri' => 'Siti',
        //     'tanggal_lahir' => '2013-07-12',
        //     'alamat' => 'lorem ipsum',
        //     'telepon' => '123',
        //     'golongan_darah' => 'A',
        //     'nama_suami' => 'Ujang'
        // ]);

        // \App\Models\Ibu::factory(10)->create();

        // \App\Models\Anak::factory(10)->create();

        // \App\Models\Kader::factory(10)->create();

        // \App\Models\Vaksin::factory(10)->create();

        // \App\Models\Penimbangan::factory(10)->create();

        // \App\Models\Imunisasi::factory(10)->create();

        // \App\Models\AOC::factory(10)->create();
        
        // \App\Models\PMBA::factory(10)->create();

        // \App\Models\Penyuluhan::factory(10)->create();

    }
}
