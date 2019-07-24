<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

	public function getByType(Request $request){

        $data['data'] = Comment::where('relation_name', $request->relation_name)->where('relation_id', $request->relation_id)->get();

        return response()->json($data, $this->successStatus);
	}

	public function update($type, $status, $id){
    	$user = Auth::user();
		$data['data'] = Comment::where('relation_name', $type)
								->where('id', $id)
								->update(['status' => $status, 'updated_at' => now()]);

        return response()->json($data, $this->successStatus);
	}
}
