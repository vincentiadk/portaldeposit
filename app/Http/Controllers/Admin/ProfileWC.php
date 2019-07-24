<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

class ProfileWC extends Controller
{
  function editprofile ()
  {
    $user = Auth::user();

    $data = $this->getProfile($user->id);

    return view('admin.profile.editprofile')->with(['datas' => $data]);
  }

  function updateprofile(Request $request){
    $user = Auth::user();

    $users = User::where('id', '!=', $user->id)->get();
    if ($user->email != $request->email) {
    	for ($i=0; $i < count($users); $i++) { 
    		if ($users[$i]->email == $request->email) {
      			return back()->with(["status"=>0]);    
    		}
    	}
    }

    if ($user->nip != $request->nip) {
    	for ($i=0; $i < count($users); $i++) { 
    		if ($users[$i]->nip == $request->nip) {
      			return back()->with(["status"=>0]);    
    		}
    	}
    }

    $rep = str_replace(' ', '', $request->password);

    if ($rep != "") {
    	$array_to_input = [
    		"name" => $request->name,
    		"email" => $request->email,
    		"nip" => $request->nip,
    		"password" => bcrypt($request->password),
    		"updated_by" => $user->id,
    		"updated_at" =>now()
    	];   
    }
    else{
    	$array_to_input = [
    		"name" => $request->name,
    		"email" => $request->email,
    		"nip" => $request->nip,
    		"updated_by" => $user->id,
    		"updated_at" =>now()
    	];  
    }

	User::where('id', $user->id)->update($array_to_input);
  	return back()->with(["status"=>1]); 
  }

  private function getProfile($id){
  	$data = User::where('id', $id)->first();

  	return $data;
  }
}
