<?php

namespace App\FirbaseEntity;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class JenisPengaduanEntity
{
    private static $nama_jenis_pengaduan = "nama_jenis_pengaduan"; 

    public static function getNamaJenisPengaduan(){
        return self::$nama_jenis_pengaduan; 
    }
}