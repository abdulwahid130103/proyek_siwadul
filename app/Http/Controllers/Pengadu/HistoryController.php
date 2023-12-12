<?php

namespace App\Http\Controllers\Pengadu;

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

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if($request->from_date != '' && $request->to_date != ''){
                $pengaduan = Pengaduan::with(['user', 'userTujuan', 'jenisPengaduan', 'notifications'])
                ->where("kd_user",Auth::user()->id)
                ->whereBetween('tanggal_pengaduan', [
                    \Carbon\Carbon::parse($request->from_date)->startOfDay(),
                    \Carbon\Carbon::parse($request->to_date)->endOfDay()
                ])
                ->latest()
                ->get();
            }else{
                $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("kd_user",Auth::user()->id)->latest()->get();
            }
            return datatables()->of($pengaduan)
                ->addIndexColumn()
                ->addColumn('jabatan', function ($pengaduan) {
                    return $pengaduan->user ? $pengaduan->user->jabatan->nama_jabatan : '-';
                })
                ->addColumn('action', 'pengadu.history.datatable.action')
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
        $countPengaduan = Pengaduan::where("kd_user",Auth::user()->id)->count();
        $countPengaduanDitinjau = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","ditinjau")->count();
        $countPengaduanDitolak = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","ditolak")->count();
        $countPengaduanTerkonfirmasi = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","terkonfirmasi")->count();
        $countPengaduanTersampaikan = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","tersampaikan")->count();
        $countPengaduanProses = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","proses")->count();
        $countPengaduanSelesai = Pengaduan::where("kd_user",Auth::user()->id)->where("STATUS","selesai")->count();
        return view('pengadu.history.index',[
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
        //
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
