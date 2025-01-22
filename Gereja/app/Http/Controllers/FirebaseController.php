<?php
namespace App\Http\Controllers;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class FirebaseController extends Controller
{
    public function readFromFirestore($id)
    {
        $firestore = new FirestoreClient([
            'keyFilePath' => '/var/www/api/MBKM_GKI/mbkm-97ba2-firebase-adminsdk-knl1a-a4125ab83d.json' // Lokasi berkas kredensial Firebase
        ]);

        $emails = 'abiliokrismanuel@gmail.com';

        $collection = $firestore->collection('UsersGKI');
        $query = $collection->where('id', '=', $id);
        $documents = $query->documents();

        foreach ($documents as $document) {
            // Lakukan sesuatu dengan data dari Firestore
            $data = $document->data();
        }

        return response()->json($data);
    }

    public function index(){
        $firestore = new FirestoreClient([
        'keyFilePath' => '/var/www/api/MBKM_GKI/mbkm-97ba2-firebase-adminsdk-knl1a-a4125ab83d.json'
        ]);

        $collection = $firestore->collection('UsersGKI');
        //$query = $collection->where('email', '=', $emails);
        $documents = $collection->documents();

        $users = [];
        foreach ($documents as $document) {
            // Lakukan sesuatu dengan data dari Firestore
            $data = $document->data();
            $users[] = $data;
        }
        return response()->json($users);
    }

    public function update(Request $request, $id){
        $firestore = new FirestoreClient([
            'keyFilePath' => '/var/www/api/MBKM_GKI/mbkm-97ba2-firebase-adminsdk-knl1a-a4125ab83d.json' // Lokasi berkas kredensial Firebase
        ]);

        $user = $firestore->collection('UsersGKI')->document($id);
        $token = $request->header('idToken');
        //$decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

        $snapshot = $user->snapshot();
        if($token == $snapshot->get('idToken')){
            $userData = $request->all();
            $user->set($userData, ['merge' => true]); // 'merge' digunakan untuk menggabungkan data baru dengan data yang ada
            return response()->json(['message' => 'Data updated successfully']);
        }else{
            return response('Unauthorized', 401);
        }
        //$userData = $request->all();
        //$user->set($userData, ['merge' => true]);
        //return response()->json(['message' => 'Data updated successfully']);
    }

    public function delete($id){
        $firestore = new FirestoreClient([
        'keyFilePath' => '/var/www/api/MBKM_GKI/mbkm-97ba2-firebase-adminsdk-knl1a-a4125ab83d.json'
        ]);

        $emails = 'abiliokrismanuel@gmail.com';

        $collection = $firestore->collection('UsersGKI');
        $query = $collection->where('id', '=', $id);
        $documents = $query->documents();

        foreach ($documents as $document) {
            // Mendapatkan referensi dokumen
            $docRef = $document->reference();

            // Menghapus dokumen dari Firestore
            $docRef->delete();
        }

        return response()->json(['message' => 'Data telah dihapus']);

    }
}
