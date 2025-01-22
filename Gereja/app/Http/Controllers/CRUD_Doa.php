<?php

namespace App\Http\Controllers;

use App\Models\Doa;
use App\Models\Admin;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CRUD_Doa extends Controller
{
    function index(){
        $data = Doa::all();
        return response()->json($data);
    }

    function show($id){
        $data = Doa::where('id',$id)->get();
        return response()->json($data);
    }

    function create(Request $request){
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        if($admin->token == $token){
            Doa::create($request->all());
            return response()->json('Data sudah ditambahkan');
        }
    }

    function destroy(Request $request, $id){
        $Doa = Doa::where('id',$id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        if($Doa->token == $token) {
            $Doa->delete();
            return response()->json('Data sudah dihapus');
        }else if($admin->token == $token){
            $Doa->delete();
            return response()->json('Data sudah dihapus');
        }else{
            return response('Unauthorized.', 401);
        }        
    }

    function update(Request $request, $id)
    {
        $Doa = Doa::where('id', $id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token', $token)->first();
        if($admin->token == $token) {
            $Doa->update($request->all());
            return response()->json('Data sudah diupdate');
        } else {
            return response('Unauthorized.', 401);
        }
    }

}
