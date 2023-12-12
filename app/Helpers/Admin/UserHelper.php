<?php
namespace App\Helpers;
 
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UserRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserHelper {
    public static function create_image( $request, $filename) {
        
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $directory = public_path('storage/user/');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            $filename = date('dmy') . "-" . time() . '.' . $gambar->getClientOriginalExtension();
            $path = $directory . $filename;
            Image::make($gambar)->save($path);
        }

        return $filename;
    }

    public static function Store($request,$filename){
        return User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kd_jabatan' => $request->kd_jabatan,
            'kode_user' => $request->kode_user,
            'alamat' => $request->alamat,
            'STATUS' => $request->STATUS,
            'foto' => $filename ?: 'user.png', // Use $filename instead of $file
        ]);
    }
    public static function Destroy($id){
        $user = User::findOrFail($id);
        
        if ($user->foto !== 'user.png') {
            $gambar_path = public_path("storage/user/{$user->foto}");
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }
        }
        $user->delete();
    }

    public static function Update($request,$id){
        if (!empty($request->file('foto_baru'))) {
    
            $old_picture_path = public_path('storage/user/'.$request->input('foto_lama'));
            if (file_exists($old_picture_path)) {
                if($request->input('foto_lama') != 'user.png'){
                    unlink($old_picture_path);
                }
            }
    
            $gambar = $request->file('foto_baru');
            $nama_gambar =  date('dmy')."-".time() . '.' . $gambar->getClientOriginalExtension();
            $path = public_path('storage/user/') . $nama_gambar;
            Image::make($gambar)->save($path);
    
            $newdata = [
                'nama' => $request->nama,
                'email' => $request->email,
                'kd_jabatan' => $request->kd_jabatan,
                'kode_user' => $request->kode_user,
                'alamat' => $request->alamat,
                'STATUS' => $request->STATUS,
                'foto' => $nama_gambar
            ];
    
        }else{
            $newdata = [
                'nama' => $request->nama,
                'email' => $request->email,
                'kd_jabatan' => $request->kd_jabatan,
                'kode_user' => $request->kode_user,
                'alamat' => $request->alamat,
                'STATUS' => $request->STATUS,
                'foto' => $request->input('foto_lama')
            ];
        }

        return $newdata;
    }

    public static function updatePassword($request){
        $validasi = Validator::make($request->all(),[
            'password' => 'required',
        ],[
            'password.required' => 'password harus diisi',
        ]);

        if($validasi->fails()){
            return response()->json(['errors'=> $validasi->errors()]);
        }else{
            $data = [
                'password' => Hash::make($request->password)
            ];
            return $data;
        }
    }
}