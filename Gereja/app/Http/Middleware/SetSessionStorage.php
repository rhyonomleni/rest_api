<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession;

class SetSessionStorage extends StartSession
{
//     protected function customStartSession($request, $session)
// {
//     // Call the parent method to start the session
//     $session = parent::startSession($request, $session);

//     // Set the session store on the request
//     $request->setSession($session);

//     return $session;
// }

}

