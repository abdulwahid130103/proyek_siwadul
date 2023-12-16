<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Jabatan;
use App\Helpers\UserHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequestUpdate;
use Illuminate\Support\Facades\Validator;
use Kreait\Laravel\Firebase\Facades\Firebase;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $user = User::with(['jabatan','pengaduan','notifications'])->latest()->get();

        if (request()->ajax()) {
            return datatables()->of($user)
                ->addIndexColumn()
                ->addColumn('kd_jabatan', function ($model){
                    return $model->jabatan->nama_jabatan;
                }) 
                ->addColumn('action', 'admin.user.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $jabatan = Jabatan::latest()->get();
        return view('Admin.user.index',[
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
    public function store(Request $request): JsonResponse
    {
        $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'kd_jabatan' => 'required',
            'kode_user' => 'required',
            'alamat' => 'required',
            'STATUS' => 'required'
        ],[
            'nama.required' => "Nama tidak boleh kosong !!",
            'email.required' => "Email tidak boleh kosong !!",
            'password.required' => "Password tidak boleh kosong !!",
            'kd_jabatan.required' => "Jabatan tidak boleh kosong !!",
            'kode_user.required' => "Kode user tidak boleh kosong !!",
            'alamat.required' => "Alamat tidak boleh kosong !!",
            'STATUS.required' => "Status tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{
            // $auth = Firebase::auth();

            // try {
            //     $userProperties = [
            //         'email' => $request->input('email'),
            //         'password' => $request->input('password'),
            //     ];
        
            //     $user = $auth->createUser($userProperties);
            //     $auth->sendEmailVerificationLink($request->input('email'));

                $filename = null;
                $filename = UserHelper::create_image($request,$filename);
                UserHelper::Store($request,$filename);
                return response()->json(["success" => "Berhasil menyimpan data user"]);
                
            // } catch (\Exception $e) {
            //     return response()->json(['success' => "error"],);
            // }
     
        }
       

   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::where('id', $id)->first();
        $jabatan = Jabatan::where('id', $data->kd_jabatan)->first();
        return response()->json([
            "result" => $data,
            "jabatan" => $jabatan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        $jabatan = Jabatan::latest()->get();
        return response()->json([
            'result' => $data,
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'email' => 'required',
            'kd_jabatan' => 'required',
            'kode_user' => 'required',
            'alamat' => 'required',
            'STATUS' => 'required'
        ],[
            'nama.required' => "Nama tidak boleh kosong !!",
            'email.required' => "Email tidak boleh kosong !!",
            'kd_jabatan.required' => "Jabatan tidak boleh kosong !!",
            'kode_user.required' => "Kode user tidak boleh kosong !!",
            'alamat.required' => "Alamat tidak boleh kosong !!",
            'STATUS.required' => "Status tidak boleh kosong !!",
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()]);
        }else{

            $newdata = UserHelper::Update($request,$id);
            User::where('id', $id)->update($newdata);
            return response()->json(['success' => 'Data user berhasil diupdate.']);
        }
        
    }

    public function updatePassword(Request $request,string $id){
   
        $data = UserHelper::updatePassword($request);
        User::where('id', $id)->update($data);
        return response()->json(['success' => "berhasil ganti password data user"]);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UserHelper::Destroy($id);
        return response()->json(['success' => "berhasil menghapus data user"]);
    }
}
