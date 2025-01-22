<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    function index(Request $request){
        $data = User::all();
        $token = $request->header('token');
        $admin = Admin::where('token',$token)->first();
        try {
            if($admin->token == $token){
                return response()->json($data);
            }else{
                return response('Unauthorized.', 401);
            }
        } catch (\Throwable $th) {
            return response('Unauthorized.', 401);
        }
        
        
    }

    function show(Request $request, $id){
        $user = User::where('id',$id)->first();
        $data = User::where('id',$id)->get();
        $token = $request->header('token');
        $admin = Admin::where('token',$token)->first();
        try {
            if($admin->token == $token){
                return response()->json($data);
            }
        } catch (\Throwable $th) {
            if($user->token == $token) {
                return response()->json($data);
            }else{
                return response('unauthorized',401);
            }
        }


        
        
    }

    function create(Request $request){
        User::create($request->all());
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        try {
            if($admin->token == $token){
                return response()->json('Data sudah ditambahkan');
            }
        } catch (\Throwable $th) {
            return response('Unauthorized.', 401);
        }
        
    }

    function destroy(Request $request, $id){
        $user = User::where('id',$id)->first();
        $token = $request->header('token');
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        $admin = Admin::where('token',$token)->first();
        try {
            if($user->token == $token) {
                $user->delete();
                return response()->json('Data sudah dihapus');
            }else if($admin->token == $token){
                $user->delete();
                return response()->json('Data sudah dihapus');
            }else{
                return response('Unauthorized.', 401);
            }
        } catch (\Throwable $th) {
            return response('Unauthorized.', 401);
        }
        
    }

    function update(Request $request,$id){
        $user = User::where('id',$id)->first();
        $token = $request->header('token');
        $admin = Admin::where('token',$token)->first();
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        try {
            if($user->token == $token) {
                $user->update($request->all());
                return response()->json('Data sudah diupdate');
            }else if($admin->token == $token){
                $user->update($request->all());
                return response()->json('Data sudah diupdate');
            }else{
                return response('Unauthorized.', 401);
            }
        } catch (\Throwable $th) {
            return response('Unauthorized.', 401);
        }
    }
}
