<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function submit(Request $request)
    {
    	$user = Auth::user();
	    // $req = $request->json()->all();
	    // dd($req['relation_name']);

    	if ($user != null){
    		$created_by = $user->id;
    		$commentator_name = $user->name;
    		$commentator_type = 'staff';
    		$commentator_id = $user->id;
    	}
    	else{
    		$created_by = 0;
    		$commentator_name = $request->name;
    		$commentator_type = 'public';
    		$commentator_id = 0;

    	}

	    $array_to_input = [
	    	"relation_name" => $request->relation_name,
	    	"relation_id" => $request->relation_id,
	    	"message" => $request->message,
	    	"commentator_name" => $commentator_name,
	    	"commentator_type" => $commentator_type,
	    	"commentator_id" => $commentator_id,
	    	"commentator_url" => "0",
	    	"status" => 0,
	    	"created_at" => now(),
	    	"updated_at" => null,
	    	"deleted_at" => null,
	    	"created_by" => $created_by,
	    	"updated_by" => null,
	    	"deleted_by" => null
	    ];


	    $data["id"] = Comment::insertGetId($array_to_input);
	    // dd($data["id"]);

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
