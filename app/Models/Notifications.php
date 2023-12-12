<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    public $table = "notifications";
    protected $fillable = [
        'judul',
        'deskripsi',
        'kd_pengaduan',
        'kd_user'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'kd_pengaduan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kd_user');
    }

}
