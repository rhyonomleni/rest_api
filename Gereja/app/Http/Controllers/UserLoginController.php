<?php

namespace App\Http\Controllers;


use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class UserLoginController extends Controller
{
    function loginManual(Request $request){
        $nama = $request->input('nama_lengkap');
        $tl = $request->input('tempat_lahir');

        $user = User::where('nama_lengkap',$nama)->first();

        if($user->tempat_lahir == $tl){
            $token = Str::random(20);
            $user->update([
                'token' => $token
            ]);
            return response()->json([
                'token'=>$token
            ]);
        }else{
            echo 'password salah';
        }
    }




    function loginGoogle(){
        $config = [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect' => env('GOOGLE_REDIRECT_URI2'),
        ];
        
        $provider = Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class,$config);
                                
        return $provider->redirect();
    }

    public function handleGoogle(){
    $config = [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI2'),
    ];

    $serviceAccount = ServiceAccount::fromValue([
        "type" => "service_account",
        "project_id" => "mbkm-97ba2",
        "private_key_id" => "a4125ab83d6a7b68bab8915d1daf3abc48ce0958",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDF/OnQzwbeYcFT\nhn2yvSpfKkkmzytnFe4PHbvs6JtXv2l5cU4ir/UkltAeLsGo0zyDFdc8CznznluB\nW/cg4OxZWlydUJUBZCeI4QROuofTV6zut9dZQS67On17x6mNkFCdk/InneAPmzar\nw+sxeDXgVICkuN/KE90xQLKIFi0E8cD7wq/4NwyjUZsyu6FhWQKeItZV1SZICTsv\n0bCbwwyM2zGjV6VCRMJJrsaMRqIX9xXRpokieSUDlqOyQgNd2n9moAp2filPFmlg\n2cuqb3kK5U37EH7FbV0sRSQLQQ7A6XauwD5tJxQhNgN1/Oa1V7aT021rPYqUGfWh\n8cNWxKz1AgMBAAECggEAAuFx9KVXqdDW7YfxW/4okK8ysKTiKN+a+gzrdgArSpe2\nwkgoslbpnWNkkz1USYXvDuJ2MGaW0nhbPiUgKZuUeOkDIM5P6p9SMAKPdKaanHYD\ndentjZ5l92x805yAP5RIT2XjWW5ACqx1VDutPPisBhP6AaIPyufzyUltYVY2crH/\njkmwlIfdSFNj1zUVA88tJM30mDh5m257KiyRfvd1YcUs/JGKuqnlzlA1mfD37/z0\nTZRrj3m2oQlIdDxVOJms2jePNSTE1Jtm2oBHvPTPhvY1mHW+X7+bAXZYNO2lXVBt\ncTM3NMhmia1phCXRmlW0DTJyQGBDVKhmJDWks4ErdwKBgQD79eq2TGMBYW/ePpAT\nxiIa7+G+nkrx0FWyc5Le0GH3kJR658UEd2XVUjT5NyQ9IT/vCGSN/9ZExkt1X2e+\nsgjjCXmIWfElWsKuW7b5kqN2IsruuTN053McEGeA7Vnr4IVJeTcLLFa3yg4kwNMT\n7cNBYJbNMYytBzlw6atd0CO84wKBgQDJKXwaYr+lNL6v+KaIv40jN6vkkzj0CLVT\n8s1oflWbqw/vkFImMZpItA4K5uWkdaXyGK+f/dOV++tCPYqQHEXMVx0RN+WS+FYp\nkWcWjM3BgoGvN5SOKtOJJ/PXIKWk98jV1NAkbs2/vU2+D+Hf50/X7k8k/6qwkT1+\nhAo7jfOuRwKBgEPiIKeW8wG3N8WgA39gXWX2hVKvIS//Wmdm3gYsDIj/qhFnClzG\nsmgD6wPOCHRz1d7X2werCxaiekgYOUJWgzBwKA9FdEQFLPh++1BIYsP8YcJpoWR4\nyzmfbdN9n0F+z0pZXywieQaxaJgcX4I6B+ZAWMDV/bnMfXxfaG0xG7/TAoGAR53B\nVRN67zIMAVIg1+Z6NOOJCuNvD1JaW/zBLEZt6/HGxp823+og52lS5oa1kwtffQVU\n4TzYqzj41KhcQFoQb2NEMfEYhm5rHnlpnhma1x3DVcIP3V1Z2iajJR+2WTjuA1K0\nl4PrNCwNFXFKFRCg2Fs7SgzLk/jhT71qdzFeY9kCgYBzDx1kHZR6IbX+LHtUr0b4\nrpQY2ps5eywxWco5ccWRa7NwIg7hrQm7iHm9NhrkjJqQvEbYQJvbRAjTQeacue4j\n9HGhrmwnJkfHdFYl0CkmezRre93h0CypgDUwhMvv09fsRg9mDskYUMDuzKQZGGhT\nmFSDUJzQqB7cMFSR3B3vDw==\n-----END PRIVATE KEY-----\n",
        "client_email" => "firebase-adminsdk-knl1a@mbkm-97ba2.iam.gserviceaccount.com",
        "client_id" => "113625375256904640981",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-knl1a%40mbkm-97ba2.iam.gserviceaccount.com",
        "universe_domain" => "googleapis.com"
    ]);
    
    $firebase = (new Factory)->withServiceAccount($serviceAccount);
    $auth = $firebase->createAuth();

    $provider = Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class,$config);                            
    $user = $provider->stateless()->user();
    $pengguna = $auth->getUserByEmail('abiliokrismanuel@gmail.com');
    $token = $pengguna->tokensValidAfterTime;
    $finduser = User::where('email', $user->email)->first();
    if($finduser) {
        $finduser->update([
            'token' => $token,
        ]);
        return response()->json([
            'token' => $auth,
            'email' => $user->email,
            'profile_picture' => $user->avatar,
        ]);
    } else {
        $this->_regis($user);
        // Auth::login($user);
    }
}

    protected function _regis($data){
        $finduser = User::where('email', $data->email)->first();
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
            'kid' => env('JWT_SECRET'),
        ];

        $payload = [
            'iat' => intval(microtime(true)),
            'exp' => intval(microtime(true)) + (60*60),
            
        ];
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256', null, $header);
        if($finduser){
            echo 'Sudah ada';
        }else{
            $user = new User();
            $user->email = $data->email;
            $user->profile_picture = $data->avatar;
            $user->token = $token;
            $user->save();
            echo 'data berhasil ditambahkan <br>';
            echo 'token = ',$token;
        }
    }
}
