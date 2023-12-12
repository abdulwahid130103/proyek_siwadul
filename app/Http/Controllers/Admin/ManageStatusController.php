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


class ManageStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::with(['user','userTujuan','jenisPengaduan','notifications'])->where("STATUS","selesai")->latest()->get();

        if (request()->ajax()) {
            return datatables()->of($pengaduan)
                ->addIndexColumn()
                ->addColumn('jabatan', function ($pengaduan) {
                    return $pengaduan->user ? $pengaduan->user->jabatan->nama_jabatan : '-';
                })
                ->addColumn('action', 'Admin.ManageStatus.Datatable.action')
                ->addColumn('actionstatus', 'Admin.ManageStatus.Datatable.actionstatus')
                ->rawColumns(['action','actionstatus'])
                ->toJson();
        }
        return view('Admin.ManageStatus.index');
    }

    public function updateStatusData(Request $request, $id)
    {
        if ($request->update_data == "public") {
            $countPublic = Pengaduan::where('status_data', 'public')->count();
            if ($countPublic >= 3) {
                $errorNotif = "Jumlah pengaduan public telah mencapai batas maksimal (3)";
                return response()->json(["error" => $errorNotif]);
            }
        }
    
        // Melakukan update status_data
        $newdata = [
            'status_data' => ($request->update_data == "public") ? "public" : "private",
        ];
        Pengaduan::where('id', $id)->update($newdata);
    
        // Memberikan notifikasi sukses
        $notif = "Pengaduan berhasil menjadi " . $request->update_data;
        return response()->json(["success" => $notif]);
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
