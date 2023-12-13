<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\JenisPengaduan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengadu = User::join('jabatan', 'users.kd_jabatan', '=', 'jabatan.id')
                    ->where('jabatan.nama_jabatan', 'pengadu')
                    ->count();
        $pengaduan = Pengaduan::where('status','selesai')->count();
        $jabatan = Jabatan::count();
        $jenis = JenisPengaduan::count();
        $pengaduanlist = Pengaduan::where("STATUS","ditinjau")->latest()->take(4)->get();
        
        return view('admin.dashboard.index',[
            'pengadu' => $pengadu,
            'pengaduan' => $pengaduan,
            // 'labelsTahun' => json_encode($labelsTahun),
            // 'dataTahun' => json_encode($dataTahun),
            // 'labelsMinggu' => json_encode($labelsMinggu),
            // 'dataMinggu' => json_encode($dataMinggu),
            // 'labelsBulan' => json_encode($labelsBulan),
            // 'dataBulan' => json_encode($dataBulan),
            'pengaduanlist' => $pengaduanlist,
            'jabatan' => $jabatan,
            'jenis' => $jenis,
        ]);
    }

    public function showProfile($id){
        $data = User::where('id', $id)->first();
        $jabatan = Jabatan::where('id', $data->kd_jabatan)->first();
        return response()->json([
            "result" => $data,
            "jabatan" => $jabatan
        ]);
    }


    public function showChartMinggu(Request $request){      
        
        if($request->STATUS == ''){
            $dataCountsMinggu = DB::table('pengaduan')
                        ->select(DB::raw('COUNT(*) AS jumlah_pengaduan'), DB::raw('DAYNAME(tanggal_pengaduan) AS hari_pengaduan'))
                        ->where('tanggal_pengaduan', '>=', DB::raw('CURDATE() - INTERVAL WEEKDAY(CURDATE()) + 1 DAY - INTERVAL 1 WEEK'))
                        ->where('tanggal_pengaduan', '<', DB::raw('CURDATE() - INTERVAL WEEKDAY(CURDATE()) + 1 DAY'))
                        ->groupBy('hari_pengaduan')
                        ->get();
        }else{
            $dataCountsMinggu = DB::table('pengaduan')
                        ->select(DB::raw('COUNT(*) AS jumlah_pengaduan'), DB::raw('DAYNAME(tanggal_pengaduan) AS hari_pengaduan'))
                        ->where('tanggal_pengaduan', '>=', DB::raw('CURDATE() - INTERVAL WEEKDAY(CURDATE()) + 1 DAY - INTERVAL 1 WEEK'))
                        ->where('tanggal_pengaduan', '<', DB::raw('CURDATE() - INTERVAL WEEKDAY(CURDATE()) + 1 DAY'))
                        ->where('STATUS',$request->STATUS)
                        ->groupBy('hari_pengaduan')
                        ->get();
        }

        return response()->json(["success" => $dataCountsMinggu]);
    }
    public function showChartBulan(Request $request){
        if($request->STATUS == ''){
            $dataCountsBulan =  DB::table('pengaduan')
                            ->select(DB::raw('COUNT(*) AS jumlah_pengaduan'), DB::raw('DATE_FORMAT(tanggal_pengaduan, "%Y-%m-%d") AS tanggal'))
                            ->where('tanggal_pengaduan', '>=', DB::raw('DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY)'))
                            ->where('tanggal_pengaduan', '<', DB::raw('DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 1 MONTH)), INTERVAL 1 DAY)'))
                            ->groupBy('tanggal')
                            ->get();
        }else{
            $dataCountsBulan =  DB::table('pengaduan')
            ->select(DB::raw('COUNT(*) AS jumlah_pengaduan'), DB::raw('DATE_FORMAT(tanggal_pengaduan, "%Y-%m-%d") AS tanggal'))
            ->where('tanggal_pengaduan', '>=', DB::raw('DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY)'))
            ->where('tanggal_pengaduan', '<', DB::raw('DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 1 MONTH)), INTERVAL 1 DAY)'))
            ->where('STATUS',$request->STATUS)
            ->groupBy('tanggal')
            ->get();
        }
        
        return response()->json(["success" => $dataCountsBulan]);
    }
    public function showChartTahun(Request $request){
        if($request->STATUS == ''){
            $dataCountsTahun = DB::table('pengaduan')
                        ->select(DB::raw("DATE_FORMAT(tanggal_pengaduan, '%Y %M') AS bulan"), DB::raw('COUNT(*) AS jumlah_pengaduan'))
                        ->where(DB::raw('DATE(tanggal_pengaduan)'), '>=', DB::raw('CURDATE() - INTERVAL 1 YEAR'))
                        ->groupBy(DB::raw("DATE_FORMAT(tanggal_pengaduan, '%Y %M')"))
                        ->get();
                        
        }else{
            $dataCountsTahun = DB::table('pengaduan')
                        ->select(DB::raw("DATE_FORMAT(tanggal_pengaduan, '%Y %M') AS bulan"), DB::raw('COUNT(*) AS jumlah_pengaduan'))
                        ->where(DB::raw('DATE(tanggal_pengaduan)'), '>=', DB::raw('CURDATE() - INTERVAL 1 YEAR'))
                        ->where('STATUS',$request->STATUS)
                        ->groupBy(DB::raw("DATE_FORMAT(tanggal_pengaduan, '%Y %M')"))
                        ->get();
            
        }

        return response()->json(["success" => $dataCountsTahun]);
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
