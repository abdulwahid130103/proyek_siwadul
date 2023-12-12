<?php

namespace App\Http\Controllers\Pengadu;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\JenisPengaduan;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PengaduanRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequestUpdate;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PengaduanRequestUpdate;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->latest()->get();

   
        $jenisPengaduan = JenisPengaduan::latest()->get();
        $jabatan = Jabatan::latest()->get();
        return view('pengadu.pengaduan.index',[
            "jenisPengaduan" => $jenisPengaduan,
            "jabatan" => $jabatan
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
            'kd_user' => 'required',
            'judul_pengaduan' => 'required',
            'deskripsi_pengaduan' => 'required',
            'kd_jenis_pengaduan' => 'required',
            'tanggal_kejadian' => 'required',
        ],[
            'kd_user.required' => "Kode user tidak boleh kosong !!",
            'judul_pengaduan.required' => "Judul pengaduan tidak boleh kosong !!",
            'deskripsi_pengaduan.required' => "Deskripsi pengaduan tidak boleh kosong !!",
            'kd_jenis_pengaduan.required' => "Jenis pengaduan tidak boleh kosong !!",
            'tanggal_kejadian.required' => "Tanggal kejadian tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{
            $filename = null;
            $name =  "PG".date('dmy') . time();
            if ($request->hasFile('gambar_pengaduan')) {
                $gambar = $request->file('gambar_pengaduan');
                $directory = public_path('storage/pengaduan/');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $filename = $name. '.' . $gambar->getClientOriginalExtension();
                $path = $directory . $filename;
                Image::make($gambar)->save($path);
                Pengaduan::create([
                    'kode_pengaduan' => $name,
                    'kd_user' => $request->kd_user,
                    'judul_pengaduan' => $request->judul_pengaduan,
                    'deskripsi_pengaduan' => $request->deskripsi_pengaduan,
                    'kd_jenis_pengaduan' => $request->kd_jenis_pengaduan,
                    'STATUS' => "ditinjau",
                    'status_data' => "private",
                    'tanggal_pengaduan' => Carbon::now('Asia/Jakarta'),
                    'tanggal_kejadian' => Carbon::createFromFormat('Y-m-d H:i', $request->tanggal_kejadian)->toDateTimeString(),
                    'gambar_pengaduan' => $filename
                ]);
                $latestComplaint = Pengaduan::latest()->first();

                Notifications::create([
                    'judul' => "pengaduan baru",
                    'deskripsi' => "pengaduan sedang ditinjau",
                    'kd_pengaduan' => $latestComplaint->id,
                    'kd_user' => $latestComplaint->kd_user,
                ]);
            }else{
                Pengaduan::create([
                    'kode_pengaduan' => $name,
                    'kd_user' => $request->kd_user,
                    'judul_pengaduan' => $request->judul_pengaduan,
                    'deskripsi_pengaduan' => $request->deskripsi_pengaduan,
                    'kd_jenis_pengaduan' => $request->kd_jenis_pengaduan,
                    'STATUS' => "ditinjau",
                    'status_data' => "private",
                    'tanggal_pengaduan' => Carbon::now(),
                    'tanggal_kejadian' => Carbon::createFromFormat('Y-m-d H:i', $request->tanggal_kejadian)->toDateTimeString(),
                ]);
                $latestComplaint = Pengaduan::latest()->first();

                Notifications::create([
                    'judul' => "pengaduan baru",
                    'deskripsi' => "pengaduan sedang ditinjau",
                    'kd_pengaduan' => $latestComplaint->id,
                    'kd_user' => $latestComplaint->kd_user,
                ]);
            }
    
            return response()->json(["success" => "Berhasil melakukan pengaduan"]);
        }


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
