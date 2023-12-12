<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
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
use App\Models\Notifications;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("kd_user",Auth::user()->id)->latest()->get();

        if (request()->ajax()) {
            return datatables()->of($pengaduan)
                ->addIndexColumn()
                ->addColumn('action', 'admin.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $jenisPengaduan = JenisPengaduan::latest()->get();
        $jabatan = Jabatan::latest()->get();
        $countPengaduan = Pengaduan::where("kd_user",Auth::user()->id)->count();
        $countPengaduanDitinjau = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","ditinjau")->count();
        $countPengaduanDitolak = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","ditolak")->count();
        $countPengaduanTerkonfirmasi = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","terkonfirmasi")->count();
        $countPengaduanTersampaikan = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","tersampaikan")->count();
        $countPengaduanProses = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","proses")->count();
        $countPengaduanSelesai = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","selesai")->count();
        return view('Admin.history.index',[
            "jenisPengaduan" => $jenisPengaduan,
            "jabatan" => $jabatan,
            "countPengaduan" => $countPengaduan,
            "countPengaduanDitolak" => $countPengaduanDitolak,
            "countPengaduanDitinjau" => $countPengaduanDitinjau,
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
    
            return response()->json(["success" => "Berhasil menyimpan data pengaduan"]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pengaduan::where('id', $id)->first();
        $user = User::where('id', $data->kd_user)->first();
        $userTujuan = User::where('id', $data->kd_user_tujuan)->first();
        $jenisPengaduan  = JenisPengaduan::where('id', $data->kd_jenis_pengaduan)->first();
        return response()->json([
            "result" => $data,
            "user" => $user,
            "userTujuan" => $userTujuan,
            "jenisPengaduan" => $jenisPengaduan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pengaduan::where('id', $id)->first();
        $jenisPengaduan = JenisPengaduan::latest()->get();
        return response()->json([
            'result' => $data,
            'jenisPengaduan' => $jenisPengaduan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validasi = Validator::make($request->all(),[
            'judul_pengaduan' => 'required',
            'deskripsi_pengaduan' => 'required',
            'kd_jenis_pengaduan' => 'required',
            'tanggal_kejadian' => 'required',
        ],[
            'judul_pengaduan.required' => "Judul pengaduan tidak boleh kosong !!",
            'deskripsi_pengaduan.required' => "Deskripsi pengaduan tidak boleh kosong !!",
            'kd_jenis_pengaduan.required' => "Jenis pengaduan tidak boleh kosong !!",
            'tanggal_kejadian.required' => "Tanggal kejadian tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{
            if (!empty($request->file('foto_baru'))) {
    
                if($request->input('foto_lama')){
                    $old_picture_path = public_path('storage/pengaduan/'.$request->input('foto_lama'));
                    if (file_exists($old_picture_path)) {
                        unlink($old_picture_path);
                    }   
                }
                $gambar = $request->file('foto_baru');
                $nama_gambar =  "PG".date('dmy') . time(). '.' . $gambar->getClientOriginalExtension();
                $path = public_path('storage/pengaduan/') . $nama_gambar;
                Image::make($gambar)->save($path);
                
                $newdata = [
                    'judul_pengaduan' => $request->judul_pengaduan,
                    'deskripsi_pengaduan' => $request->deskripsi_pengaduan,
                    'kd_jenis_pengaduan' => $request->kd_jenis_pengaduan,
                    'status_data' => "private",
                    'tanggal_kejadian' => Carbon::createFromFormat('Y-m-d H:i', $request->tanggal_kejadian)->toDateTimeString(),
                    'gambar_pengaduan' => $nama_gambar,
                ];
            }else{
                $newdata = [
                    'judul_pengaduan' => $request->judul_pengaduan,
                    'deskripsi_pengaduan' => $request->deskripsi_pengaduan,
                    'kd_jenis_pengaduan' => $request->kd_jenis_pengaduan,
                    'tanggal_kejadian' => Carbon::createFromFormat('Y-m-d H:i', $request->tanggal_kejadian)->toDateTimeString(),
                    'gambar_pengaduan' => $request->foto_lama,
                ];
            }
            Pengaduan::where('id', $id)->update($newdata);
            return response()->json(["success" => "Berhasil update data pengaduan"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        if($pengaduan->gambar_pengaduan != null){
            $gambar_path = public_path("storage/pengaduan/{$pengaduan->gambar_pengaduan}");
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }
        }
    
        $pengaduan->delete();
        return response()->json(['success' => "berhasil menghapus data pengaduan"]);
    }
}
