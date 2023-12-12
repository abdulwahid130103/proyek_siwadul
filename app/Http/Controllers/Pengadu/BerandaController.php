<?php

namespace App\Http\Controllers\Pengadu;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::where('STATUS','selesai')->count();
        $pengaduanAll = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("status_data","public")->latest()->get();
        return view('pengadu.beranda.index',[
            "pengaduan" => $pengaduan,
            "pengaduanAll" => $pengaduanAll,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'kode_pengaduan' => 'required',
        ],[
            'kode_pengaduan.required' => 'kode pengaduan harus diisi',
        ]);

        if($validasi->fails()){
            return response()->json(['error'=> "Input Tidak boleh kosong !!"]);
        }else{
            $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])
            ->where('kode_pengaduan',$request->kode_pengaduan)
            ->latest()
            ->get()
            ->first();
    
            if($pengaduan){
                $data = [
                    "kode_pengaduan" => $pengaduan->kode_pengaduan,
                    "judul_pengaduan" => $pengaduan->judul_pengaduan,
                    "kd_jenis_pengaduan " => $pengaduan->jenisPengaduan->nama_jenis_pengaduan,
                    "STATUS" => $pengaduan->STATUS,
                    "tanggal_pengaduan" => $pengaduan->tanggal_pengaduan,
                ];
            }else{
                return response()->json(["error" => "kode pengaduan tidak valid !!"]);
            }
        }
      
        return response()->json(["success" => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
