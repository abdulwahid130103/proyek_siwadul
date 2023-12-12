<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\JenisPengaduan;
use App\Exports\PengaduanExport;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PengaduanRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequestUpdate;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PengaduanRequestUpdate;

class LaporanPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if (request()->ajax()) {
            if($request->from_date != '' && $request->to_date != ''){
                $pengaduan = Pengaduan::with(['user', 'userTujuan', 'jenisPengaduan', 'notifications'])
                ->whereBetween('tanggal_pengaduan', [
                    \Carbon\Carbon::parse($request->from_date)->startOfDay(),
                    \Carbon\Carbon::parse($request->to_date)->endOfDay()
                ])
                ->latest()
                ->get();
            }else{
                $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->latest()->get();
            }
            return datatables()->of($pengaduan)
                ->addIndexColumn()
                ->addColumn('jabatan', function ($pengaduan) {
                    return $pengaduan->user ? $pengaduan->user->jabatan->nama_jabatan : '-';
                })
                ->addColumn('action', 'admin.laporanPengaduan.datatable.action')
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
        return view('Admin.LaporanPengaduan.index',[
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

    public function laporanPengaduanData(Request $request){
        // $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->latest()->get();
        if ($request->ajax()) {
 
            if ($request->input('start_date') && $request->input('end_date')) {
 
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));
 
                if ($end_date->greaterThan($start_date)) {
                    $pengaduan = Pengaduan::whereBetween('tanggal_pengaduan', [$start_date, $end_date])->get();
                } else {
                    $pengaduan = Pengaduan::latest()->get();
                }
            } else {
                $pengaduan = Pengaduan::latest()->get();
            }
 
            return response()->json(['pengaduan' => $pengaduan]);
        } else {
            abort(403);
        }
    }

    public function exportExcellPengaduan(){
        return Excel::download(new PengaduanExport,'Pengaduan.xlsx');
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
