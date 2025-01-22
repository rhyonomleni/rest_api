<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Admin;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CRUD_Kegiatan extends Controller
{
    function index(){
        $data = Kegiatan::all();
        return response()->json($data);
    }

    function show($id){
        $data = Kegiatan::where('id',$id)->get();
        return response()->json($data);
    }

    function create(Request $request){
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        if($admin->token == $token){
            $image = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('media',$image);
            $gambar = url('/').'/media/'.$image;
            $kegiatan = Kegiatan::create($request->all());
            $kegiatan->gambar = $gambar;
            $kegiatan->save();
            return response()->json('Data sudah ditambahkan');
        }
    }

    function destroy(Request $request, $id){
        $kegiatan = Kegiatan::where('id',$id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        try {
            if($kegiatan->token == $token) {
                $kegiatan->delete();
                return response()->json('Data sudah dihapus');
            }else if($admin->token == $token){
                $kegiatan->delete();
                return response()->json('Data sudah dihapus');
            }else{
                return response('Unauthorized.', 401);
            }
        } catch (\Throwable $th) {
            return response('Unauthorized.', 401);
        }
        
    }

    function update(Request $request, $id)
    {
        $Kegiatan = Kegiatan::where('id', $id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token', $token)->first();
        if($admin->token == $token) {
            if ($request->hasFile('gambar')) {
                if ($Kegiatan->gambar) {
                    $oldImagePath = app()->basePath('public') . '/upload/' . $Kegiatan->gambar;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
            $gambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload',$gambar);
            $image = url('/').'/media/'.$gambar;
            $Kegiatan->gambar = $image;
            $Kegiatan->save();
            $Kegiatan->update($request->all());
            return response()->json('Data sudah ditambahkan');
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
