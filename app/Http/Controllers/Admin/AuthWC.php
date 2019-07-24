<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthWC extends Controller
{
 //  function loginView ()
 //  {
	// 	$token = session()->get('token');
 //    if(empty($token))
 //      return view('admin.login');
 //    else return redirect('/');
	// }

 //  function login (Request $request)
 //  {
 //    $data = get_variable();
 //    //dd($data["url_client"]);
 //    $url = url($data["url_client"].'/login');

 //    $client = new \GuzzleHttp\Client();
 //    $res = $client->request('POST', $url, [
 //      'json' => [
 //          'email' => $request->username,
 //          'password' => $request->password
 //      ]
 //    ]);

 //    $res = json_decode($res->getBody());
 //    if($res->success->message == 0) 
 //    {
 //      session(["token" => $res->success->token]);
 //      return Redirect('/bo');
 //    }
 //    else
 //    {
 //      return back()->withErrors(['msg'=> 'Username dan password tidak sesuai']);
 //    } 
        
 //  }

  function logout ()
  {
    Auth::logout();
    return redirect('/login');
  }
}
