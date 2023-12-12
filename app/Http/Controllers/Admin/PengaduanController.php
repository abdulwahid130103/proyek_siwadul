<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\JenisPengaduan;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengaduanRequest;
use App\Http\Requests\PengaduanRequestUpdate;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestUpdate;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->latest()->get();

        if (request()->ajax()) {
            return datatables()->of($pengaduan)
                ->addIndexColumn()
                ->addColumn('jabatan', function ($pengaduan) {
                    return $pengaduan->user ? $pengaduan->user->jabatan->nama_jabatan : '-';
                })
                ->addColumn('action', 'admin.pengaduan.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $jenisPengaduan = JenisPengaduan::latest()->get();
        $jabatan = Jabatan::latest()->get();
        $user = User::join('jabatan', 'users.kd_jabatan', '=', 'jabatan.id')
                    ->where('jabatan.nama_jabatan', 'kaprodi')
                    ->orWhere('jabatan.nama_jabatan', 'laboran')
                    ->orWhere('jabatan.nama_jabatan', 'adminprodi')
                    ->get();
        // $user = User::latest()->get();
        $countPengaduan = Pengaduan::count();
        $countPengaduanDitinjau = Pengaduan::where("STATUS","ditinjau")->count();
        $countPengaduanDitolak = Pengaduan::where("STATUS","ditolak")->count();
        $countPengaduanTerkonfirmasi = Pengaduan::where("STATUS","terkonfirmasi")->count();
        $countPengaduanTersampaikan = Pengaduan::where("STATUS","tersampaikan")->count();
        $countPengaduanProses = Pengaduan::where("STATUS","proses")->count();
        $countPengaduanSelesai = Pengaduan::where("STATUS","selesai")->count();
        return view('Admin.pengaduan.index',[
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
