<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\Admin;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CRUD_Ibadah extends Controller
{
    function index(){
        $data = Ibadah::all();
        return response()->json($data);
    }

    function show($id){
        $data = Ibadah::where('id',$id)->get();
        return response()->json($data);
    }

    function create(Request $request){
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        if($admin->token == $token){
            $image1 = $request->file('foto_pendeta')->getClientOriginalName();
            $image2 = $request->file('gambar')->getClientOriginalName();
            $request->file('foto_pendeta')->move('media',$image1);
            $request->file('gambar')->move('media',$image2);
            $gambar1 = url('/').'/media/'.$image1;
            $gambar2 = url('/').'/media/'.$image2;
            $ibadah = Ibadah::create($request->all());
            $ibadah->foto_pendeta = $gambar1;
            $ibadah->gambar = $gambar2;
            $ibadah->save();
            return response()->json('Data sudah ditambahkan');
        }
    }

    function destroy(Request $request, $id){
        $ibadah = Ibadah::where('id',$id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        try {
            if($admin->token == $token){
                $ibadah->delete();
                $oldImagePath1 = app()->basePath('public') . '/media/' . basename($ibadah->foto_pendeta);
                $oldImagePath2 = app()->basePath('public') . '/media/' . basename($ibadah->gambar);
                if (file_exists($oldImagePath1)) {
                    unlink($oldImagePath1);
                }
                if (file_exists($oldImagePath2)) {
                    unlink($oldImagePath2);
                }
                return response()->json('Data sudah dihapus');
            }else{
                return response('Unauthorized.', 401);
            }
        } catch (\Throwable $th) {
            return response('Unauthorized.', 401);
        }
        
    }

    function update(Request $request,$id){
        $ibadah = Ibadah::where('id', $id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token', $token)->first();
        if($admin->token == $token) {
            if ($request->hasfile('gambar') || $request->hasfile('foto_pendeta')){
                if ($request->hasFile('gambar')) {
                    if ($ibadah->gambar) {
                        $oldImagePath1 = app()->basePath('public') . '/media/' . basename($ibadah->gambar);
                        if (file_exists($oldImagePath1)) {
                            unlink($oldImagePath1);
                        } else {
                            return response()->json('Data tidak ada');
                        }
                    }
                    $file1 = $request->File('gambar');
                    $image1 = $file1->getClientOriginalName();
                    $request->file('gambar')->move('media', $image1);
                    $gambar1 = url('/') . '/media/' . $image1;
                    $ibadah->update($request->except('foto_pendeta'));
                    $ibadah->gambar = $gambar1;
                }
                if ($request->hasFile('foto_pendeta')) {
                    if ($ibadah->foto_pendeta) {
                        $oldImagePath1 = app()->basePath('public') . '/media/' . basename($ibadah->foto_pendeta);
                        if (file_exists($oldImagePath1)) {
                            unlink($oldImagePath1);
                        } else {
                            return response()->json('Data tidak ada');
                        }
                    }
                    $file2 = $request->File('foto_pendeta');
                    $image2 = $file2->getClientOriginalName();
                    $request->file('foto_pendeta')->move('media', $image2);
                    $gambar2 = url('/') . '/media/' . $image2;
                    $ibadah->update($request->except('gambar'));
                    $ibadah->foto_pendeta = $gambar2;
                }
                $ibadah->save();
                return response()->json('Data sudah diupdate');
            }else{
                $ibadah->update($request->all());
                return response()->json('Data tidak ada');
            }
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
