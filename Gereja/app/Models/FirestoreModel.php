<?php

namespace App\Models;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Database\Eloquent\Model;

class FirestoreModel extends Model
{
    protected $firestore;

    public function __construct()
    {
        $config = config('database.firestore');

        $this->firestore = new FirestoreClient([
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
    }

    // Tambahkan metode untuk berinteraksi dengan Firestore di sini
    public function getCollection($collectionName)
    {
        return $this->firestore->collection($collectionName);
    }
}
