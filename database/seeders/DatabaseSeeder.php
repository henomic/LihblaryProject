<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Container\Attributes\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        FacadesDB::table('users')->insert([
            'username' => 'admin123',
            'nama_lengkap' => 'Galih Ganteng',
            'alamat' => 'Jl. Contoh No. 123, Bandung',
            'nik' => '3201010101010001',
            'email' => 'admin@gmail.com',
            'level' => 'admin',
            'email_verified_at' => Carbon::now(),
            'password' => FacadesHash::make('password123'),
            'foto' => 'default.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'aktif',
        ]);
    }
}
