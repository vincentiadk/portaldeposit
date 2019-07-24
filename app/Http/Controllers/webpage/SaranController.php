<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Saran;

class SaranController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function submit(Request $request)
    {
	    $array_to_input = [
	    	"name" =>$request->name,
	    	"email" => $request->email,
	    	"message" => $request->message,
	    	"created_at" => now()
	    ];

	    $data["id"] = Saran::insertGetId($array_to_input);

	    if ($data["id"] != null) 
	    {
	      $data["message"] = "success";
	      return response()->json($data, $this->successStatus);
	    }
	    else
	    {
	      $data["message"] = "error";
	      return response()->json($data, $this->errorStatus);
	    }
    }
}
