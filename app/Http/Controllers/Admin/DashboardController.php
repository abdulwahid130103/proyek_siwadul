<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\JenisPengaduan;
use App\Models\Pengaduan;

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
        $days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        // Get the current day and adjust the order of days
        $currentDayIndex = date('N') - 1;
        $orderedDays = array_merge(array_slice($days, $currentDayIndex), array_slice($days, 0, $currentDayIndex));
        
        // Get the start date for the last week
        $startDate = date('Y-m-d', strtotime('-1 week'));
        
        $dataCounts = Pengaduan::selectRaw('COUNT(*) as count, DAYNAME(tanggal_pengaduan) as day')
            ->where('tanggal_pengaduan', '>=', $startDate)
            ->groupBy('day')
            ->orderByRaw('FIELD(day, "' . implode('","', $orderedDays) . '")')
            ->pluck('count', 'day')
            ->toArray();
        
    
        
        return view('admin.dashboard.index',[
            'pengadu' => $pengadu,
            'pengaduan' => $pengaduan,
            'days' => $days,
            'dataCounts' => $dataCounts,
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
