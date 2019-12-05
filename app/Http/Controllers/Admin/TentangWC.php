<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Rule;

class TentangWC extends Controller
{
	public function tentangView(){
		$data = Rule::with('createdBy', 'updatedBy')->where('type', 'tentang')->first();
		return view('admin.tentang.tentang')->with(['data'=>$data, "action"=>"/bo/tentang/save"]);
	}

	public function save(Request $req)
	{
		$user = Auth::user();

		if (isset($req->simpan)){
			$array_to_input = [
				"type" => "tentang",
				"title" => "Tentang Kami",
				"slug" => "tentang/tentang-kami",
				"datetime" => now(),
				"is_comment" => 1,
				"description" => $req->description,
				"status" => "published",
				"created_by" => $user->id,
				"created_at" => now()
			];

			$data = Rule::insertGetId($array_to_input);

		    if ($data != null) $res =1; //success
		    else $res = 0; //failed
		} else if(isset($req->update)){
			$array_to_input = [
				"type" => "tentang",
				"title" => "Tentang Kami",
				"slug" => "tentang/tentang-kami",
				"description" => $req->description,
				"updated_by" => $user->id,
				"updated_at" => now()
			];

			$res = Rule::where('id', $req->id)->update($array_to_input);
		}

		if ($res == 0) {
			return back()->with(["status"=>0]);    
		} else {
			return back()->with(["status"=>1]);
		}  
	}
}
