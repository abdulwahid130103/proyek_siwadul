<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\JenisPengaduan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\JenisPengaduanRequest;

class JenisPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisPengaduan = JenisPengaduan::with('pengaduans')->latest()->get();

        if (request()->ajax()) {
            return datatables()->of($jenisPengaduan)
                ->addIndexColumn()
                ->addColumn('action', 'admin.JenisPengaduan.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Admin.JenisPengaduan.index');
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
            'nama_jenis_pengaduan' => 'required',
        ],[
            'nama_jenis_pengaduan.required' => "Nama jenis pengaduan tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{
            JenisPengaduan::create([
                'nama_jenis_pengaduan' => $request->nama_jenis_pengaduan,
            ]);
            return response()->json(["success" => "Berhasil menyimpan data jenis pengaduan"]);
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
        $data = JenisPengaduan::where('id', $id)->first();
        return response()->json([
            'result' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(),[
            'nama_jenis_pengaduan' => 'required',
        ],[
            'nama_jenis_pengaduan.required' => "Nama jenis pengaduan tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{
            JenisPengaduan::where('id',$id)->update([
                'nama_jenis_pengaduan' => $request->nama_jenis_pengaduan,
            ]);
            return response()->json([ "success" => "Berhasil mengupdate data jenis pengaduan"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JenisPengaduan::where('id',$id)->delete();
        return response()->json([ "success" => "Berhasil menghapus data jenis pengaduan"]);
    }
}
