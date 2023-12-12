<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengaduanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->latest()->get();
        $data = [];
        foreach ($pengaduan as $index => $pengaduan) {
            $row = [
                $index + 1,
                $pengaduan->kode_pengaduan,
                $pengaduan->kd_user,
                $pengaduan->kd_user_tujuan,
                $pengaduan->judul_pengaduan,
                $pengaduan->deskripsi_pengaduan,
                $pengaduan->kd_jenis_pengaduan,
                $pengaduan->STATUS,
                $pengaduan->status_data,
                $pengaduan->gambar_pengaduan,
                $pengaduan->tanggal_pengaduan,
                $pengaduan->tanggal_kejadian,
                $pengaduan->deskripsi_penyelesaian,
                $pengaduan->bukti_selesai,
                $pengaduan->tanggal_selesai_pengaduan
            ];

            array_push($data, $row);
        }

        return collect($data);
    }
    public function headings(): array
    {
        return [
            'No',
            'kode_pengaduan',
            'User',
            'User Tujuan',
            'Judul Pengaduan',
            'Deskripsi Pengaduan',
            'Jenis Pengaduan',
            'STATUS',
            'status_data',
            'Gambar Pengaduan',
            'Tanggal Pengaduan',
            'Tanggal Kejadian',
            'Deskripsi Penyelesaian',
            'Bukti Selesai',
            'Tanggal Selesai Pengaduan'
        ];
    }
}
