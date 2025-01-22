<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Renungan;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CRUD_Renungan extends Controller
{
    function index(){
        $data = Renungan::all();
        return response()->json($data);
    }

    function show($id){
        $data = Renungan::where('id',$id)->get();
        return response()->json($data);
    }

    function create(Request $request){
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        if($admin->token == $token){
            Renungan::create($request->all());
            return response()->json('Data sudah ditambahkan');
        }
    }

    function destroy(Request $request, $id){
        $Renungan = Renungan::where('id',$id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        if($Renungan->token == $token) {
            $Renungan->delete();
            return response()->json('Data sudah dihapus');
        }else if($admin->token == $token){
            $Renungan->delete();
            return response()->json('Data sudah dihapus');
        }else{
            return response('Unauthorized.', 401);
        }        
    }

    function update(Request $request, $id)
    {
        $Renungan = Renungan::where('id', $id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token', $token)->first();
        if($admin->token == $token) {
            $Renungan->update($request->all());
            return response()->json('Data sudah diupdate');
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
