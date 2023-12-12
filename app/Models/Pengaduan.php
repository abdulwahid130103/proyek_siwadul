<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    public $table = "pengaduan";
    protected $fillable = [
        'kode_pengaduan',
        'kd_user',
        'kd_user_tujuan',
        'judul_pengaduan',
        'deskripsi_pengaduan',
        'kd_jenis_pengaduan',
        'STATUS',
        'status_data',
        'gambar_pengaduan',
        'deskripsi_penyelesaian',
        'bukti_selesai',
        'tanggal_pengaduan',
        'tanggal_kejadian',
        'tanggal_selesai_pengaduan'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'kd_user');
    }

    public function userTujuan()
    {
        return $this->belongsTo(User::class, 'kd_user_tujuan');
    }

    public function jenisPengaduan()
    {
        return $this->belongsTo(JenisPengaduan::class, 'kd_jenis_pengaduan');
    }

    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'kd_pengaduan');
    }

}
