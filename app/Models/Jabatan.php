<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    public $table = "jabatan";
    protected $fillable = [
        'nama_jabatan'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'kd_jabatan');
    }
}
