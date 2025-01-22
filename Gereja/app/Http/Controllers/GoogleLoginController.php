<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Firebase\JWT\JWT;
use Google\Service\CloudSearch\AvatarInfo;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Session\Store;

Session::start();
class GoogleLoginController extends Controller
{

    // protected $session;

    // public function __construct(Store $session)
    // {
    //     $this->session = $session;
    // }

    public function redirectToGoogle(){
        $redirect = Socialite::with('google')->stateless()->redirect();

        // Atur header CORS pada respons redirect
        return response($redirect)
        ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorizations');
    }

    public function handleGoogleCallback(){
        $user = Socialite::with('google')->stateless()->user();
        $finduser = Admin::where('email', $user->email)->first();
        if($finduser){
            $header = [
                'alg' => 'HS256', 
                'typ' => 'JWT',
                'kid' => env('JWT_SECRET'),
                'email' => $user->email,
                'google_id' => $user->google_id
            ];

            $payload = [
                'iat' => intval(microtime(true)),
                'exp' => intval(microtime(true)) + (60*60),
                
            ];
            $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256', null, $header);
            $finduser->update([
                'token' => $token
            ]);
            return response()->json($token);
        }else{
            $this->_regis($user);
            // Auth::login($user);
        }
        //return response()->json([
        //  'api_token' => $apiToken
        //]);



        try {
            // $user = Socialite::driver('google')->user();

            // if($finduser){
            //     Auth::login($finduser);
            //     return redirect()->intended('dashboard');
            // }else{
            //     $newuser = User::create([
            //         'name' => $user->getName(),
            //         'username' => $user->getEmail(),
            //         'email' => $user->getEmail(),
            //         'google_id' => $user->getId(),
            //         'password' => '12345566'
            //     ]);
            //     Auth::login($newuser);
            // }

        } catch (\Throwable $th) {
            //
        }
    }

    protected function _regis($data){
        $finduser = Admin::where('email', $data->email)->first();
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
            'kid' => env('JWT_SECRET'),
        ];

        $payload = [
            'iat' => intval(microtime(true)),
            'exp' => intval(microtime(true)) + (3600),
            
        ];
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256', null, $header);
        if($finduser){
            echo 'Sudah ada';
        }else{
            $user = new Admin();
            $user->username = $data->name;
            $user->email = $data->email;
            $user->google_id = $data->id;
            $user->profile_picture = $data->avatar;
            $user->token = $token;
            $user->save();
            echo 'sudah ditambahkan <br>';
            echo 'token : ', $token;
        }
    }
}
