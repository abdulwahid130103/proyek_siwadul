<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('jenis_pengaduan')->insert([
            'nama_jenis_pengaduan' => "Saran",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('jenis_pengaduan')->insert([
            'nama_jenis_pengaduan' => "Fasilitas",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => "admin",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => "pengadu",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => "laboran",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => "adminprodi",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => "kaprodi",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('users')->insert([
            'nama' => "admin",
            'kode_user' => "2131830030",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin'),
            'kd_jabatan' => 1,
            'alamat' => "Mojokerto",
            'status' => "Aktif",
            'foto' => "user.png",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('users')->insert([
            'nama' => "pengadu",
            'kode_user' => "123",
            'email' => "pengadu@gmail.com",
            'password' => Hash::make('pengadu'),
            'kd_jabatan' => 2,
            'alamat' => "Mojokerto",
            'status' => "Aktif",
            'foto' => "user.png",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('users')->insert([
            'nama' => "laboran",
            'kode_user' => "234",
            'email' => "laboran@gmail.com",
            'password' => Hash::make('laboran'),
            'kd_jabatan' => 3,
            'alamat' => "Mojokerto",
            'status' => "Aktif",
            'foto' => "user.png",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('users')->insert([
            'nama' => "adminprodi",
            'kode_user' => "345",
            'email' => "adminprodi@gmail.com",
            'password' => Hash::make('adminprodi'),
            'kd_jabatan' => 4,
            'alamat' => "Mojokerto",
            'status' => "Aktif",
            'foto' => "user.png",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
        DB::table('users')->insert([
            'nama' => "kaprodi",
            'kode_user' => "456",
            'email' => "kaprodi@gmail.com",
            'password' => Hash::make('kaprodi'),
            'kd_jabatan' => 5,
            'alamat' => "Mojokerto",
            'status' => "Aktif",
            'foto' => "user.png",
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);
    }
}
