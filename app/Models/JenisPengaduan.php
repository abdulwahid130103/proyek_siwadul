<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengaduan extends Model
{
    use HasFactory;
    public $table = "jenis_pengaduan";
    protected $fillable = [
        'nama_jenis_pengaduan'
    ];
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'kd_jenis_pengaduan');
    }
}
