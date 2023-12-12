<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JabatanRequest;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::with('users')->latest()->get();

        if (request()->ajax()) {
            return datatables()->of($jabatan)
                ->addIndexColumn()
                ->addColumn('action', 'admin.jabatan.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Admin.jabatan.index');
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
            'nama_jabatan' => 'required',
        ],[
            'nama_jabatan.required' => "Nama jabatan tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{

            Jabatan::create([
                'nama_jabatan' => $request->nama_jabatan,
            ]);
            return response()->json(["success" => "Berhasil menyimpan data jabatan"]);
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
        $data = Jabatan::where('id', $id)->first();
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
            'nama_jabatan' => 'required',
        ],[
            'nama_jabatan.required' => "Nama jabatan tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{

            Jabatan::where('id',$id)->update([
                    'nama_jabatan' => $request->nama_jabatan,
                ]);
            return response()->json([ "success" => "Berhasil mengupdate data jabatan"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Jabatan::where('id',$id)->delete();
        return response()->json([ "success" => "Berhasil menghapus data jabatan"]);
    }
}
