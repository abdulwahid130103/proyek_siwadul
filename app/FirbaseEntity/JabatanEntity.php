<?php

namespace App\FirbaseEntity;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class JabatanEntity
{
    private static $nama_jabatan = "nama_jabatan"; 

    public static function getNamaJabatan(){
        return self::$nama_jabatan; 
    }
}