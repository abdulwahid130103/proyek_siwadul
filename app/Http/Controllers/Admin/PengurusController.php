<?php

namespace App\Http\Controllers\Admin;

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

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->jabatan->nama_jabatan == "kaprodi"){
            $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("kd_user_tujuan",Auth::user()->id)->orWhere("STATUS","ditinjau")->orWhere("STATUS","ditolak")->latest()->get();
        }else if(Auth::user()->jabatan->nama_jabatan == "admin"){
            $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("kd_user_tujuan",Auth::user()->id)->orWhere("STATUS","terkonfirmasi")->latest()->get();
        }else{
            $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("kd_user_tujuan",Auth::user()->id)->latest()->get();
        }
        if (request()->ajax()) {
            return datatables()->of($pengaduan)
                ->addIndexColumn()
                ->addColumn('jabatan', function ($pengaduan) {
                    return $pengaduan->user ? $pengaduan->user->jabatan->nama_jabatan : '-';
                })
                ->addColumn('action', 'admin.pengurus.datatable.action')
                ->rawColumns(['action','actionstatus'])->toJson();
        }
        
        
        $jenisPengaduan = JenisPengaduan::latest()->get();
        $jabatan = Jabatan::latest()->get();
        $user = User::join('jabatan', 'users.kd_jabatan', '=', 'jabatan.id')
                    ->whereIn('jabatan.nama_jabatan', ['kaprodi', 'laboran', 'adminprodi'])
                    ->select('users.*')
                    ->get('users');
        

        if(Auth::user()->jabatan->nama_jabatan == "kaprodi"){
            $countPengaduan = Pengaduan::where("kd_user_tujuan",Auth::user()->id)->orWhere("STATUS","ditinjau")->count();
        }else if(Auth::user()->jabatan->nama_jabatan == "admin"){
            $countPengaduan = Pengaduan::where("kd_user_tujuan",Auth::user()->id)->orWhere("STATUS","terkonfirmasi")->count();
        }else{
            $countPengaduan = Pengaduan::where("kd_user_tujuan",Auth::user()->id)->count();
        }
        $countPengaduanDitinjau = Pengaduan::where("STATUS","ditinjau")->count();
        $countPengaduanDitolak = Pengaduan::where("STATUS","ditolak")->count();
        $countPengaduanTerkonfirmasi = Pengaduan::where("STATUS","terkonfirmasi")->count();
        $countPengaduanTersampaikan = Pengaduan::where("kd_user_tujuan",Auth::user()->id)->where("STATUS","tersampaikan")->count();
        $countPengaduanProses = Pengaduan::where("kd_user_tujuan",Auth::user()->id)->where("STATUS","proses")->count();
        $countPengaduanSelesai = Pengaduan::where("kd_user_tujuan",Auth::user()->id)->where("STATUS","selesai")->count();
        return view('Admin.pengurus.index',[
            "jenisPengaduan" => $jenisPengaduan,
            "jabatan" => $jabatan,
            "user" => $user,
            "countPengaduan" => $countPengaduan,
            "countPengaduanDitinjau" => $countPengaduanDitinjau,
            "countPengaduanDitolak" => $countPengaduanDitolak,
            "countPengaduanTerkonfirmasi" => $countPengaduanTerkonfirmasi,
            "countPengaduanTersampaikan" => $countPengaduanTersampaikan,
            "countPengaduanProses" => $countPengaduanProses,
            "countPengaduanSelesai" => $countPengaduanSelesai,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function konfirmasiKaprodi($id){
        $newdata = [
            'STATUS' => "terkonfirmasi",
        ];
        Pengaduan::where('id', $id)->update($newdata);
        $pengaduan = Pengaduan::where('id', $id)->first();
        Notifications::create([
            'judul' => "pengaduan baru",
            'deskripsi' => "pengaduan sudah dikonfirmasi",
            'kd_pengaduan' => $pengaduan->id,
            'kd_user' => $pengaduan->kd_user,
        ]);
        return response()->json(["success" => "Pengaduan berhasil terkonfirmasi"]);
    }
    public function tolakPengaduan($id){
        $newdata = [
            'STATUS' => "ditolak",
        ];
        Pengaduan::where('id', $id)->update($newdata);
        $pengaduan = Pengaduan::where('id', $id)->first();
        Notifications::create([
            'judul' => "pengaduan baru",
            'deskripsi' => "pengaduan sudah ditolak",
            'kd_pengaduan' => $pengaduan->id,
            'kd_user' => $pengaduan->kd_user,
        ]);
        return response()->json(["success" => "Pengaduan berhasil ditolak"]);
    }

    public function konfirmasiTersampaikan($id){
        $newdata = [
            'STATUS' => "proses",
        ];
        Pengaduan::where('id', $id)->update($newdata);
        $pengaduan = Pengaduan::where('id', $id)->first();
        Notifications::create([
            'judul' => "pengaduan baru",
            'deskripsi' => "pengaduan sudah proses",
            'kd_pengaduan' => $pengaduan->id,
            'kd_user' => $pengaduan->kd_user,
        ]);
        return response()->json(["success" => "Pengaduan berhasil menjadi proses"]);
    }
    

    public function konfirmasiAdmin(Request $request,$id){
        $newdata = [
            'STATUS' => "tersampaikan",
            'kd_user_tujuan' => $request->kd_user_tujuan
        ];
        Pengaduan::where('id', $id)->update($newdata);
        $pengaduan = Pengaduan::where('id', $id)->first();
        Notifications::create([
            'judul' => "pengaduan baru",
            'deskripsi' => "pengaduan sudah tersampaikan",
            'kd_pengaduan' => $pengaduan->id,
            'kd_user' => $pengaduan->kd_user,
        ]);
        return response()->json(["success" => "Pengaduan berhasil menjadi tersampaikan"]);
    }

    public function konfirmasiSelesai(Request $request,$id){
        $filename = null;
        $name =  "BS".date('dmy') . time();
        if ($request->hasFile('bukti_selesai')) {
            $gambar = $request->file('bukti_selesai');
            $directory = public_path('storage/penyelesaian/');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            $filename = $name. '.' . $gambar->getClientOriginalExtension();
            $path = $directory . $filename;
            Image::make($gambar)->save($path);

            $newdata = [
                'STATUS' => "selesai",
                'deskripsi_penyelesaian' => $request->deskripsi_penyelesaian,
                'bukti_selesai' => $filename
            ];
        }else{
            $newdata = [
                'STATUS' => "selesai",
                'deskripsi_penyelesaian' => $request->deskripsi_penyelesaian
            ];
        }
        Pengaduan::where('id', $id)->update($newdata);
        $pengaduan = Pengaduan::where('id', $id)->first();
        Notifications::create([
            'judul' => "pengaduan baru",
            'deskripsi' => "pengaduan sudah selesai",
            'kd_pengaduan' => $pengaduan->id,
            'kd_user' => $pengaduan->kd_user,
        ]);
        return response()->json(["success" => "Pengaduan berhasil terselesaikan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
