<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Galery;

class SliderWC extends Controller
{
  function slider ()
  {
  	$data['galeries'] = Galery::where('table_name', 'slider')->get();
    return view('admin.slider.slider', $data);
  }

  function update(Request $request){

    $files_error=0;
    $status=0;
  	if ($request->has('delete_id')) {
      	foreach ($request->delete_id as $did) {
        	$file = Galery::find($did);
        	if ($file != null) {
         	File::delete(storage_path('app/public/slider/'.$file->file_name));
          	$file->delete();
        	}
       
  	    }
	}
	if($request->hasFile('files'))
  	{

     	$files = $request->file('files');
      	$format = array('jpg','jpeg','png');
      	foreach ($files as $file) {
        	if ($file->getSize() > 100000000) {
          		$files_error++;
        	}
        	else if (!in_array($file->getClientOriginalExtension(), $format)) {
            	$files_error++;
        	}else{
          		$file_name = Uuid::generate()->string.'.'.$file->getClientOriginalExtension();
          		$file->storeAs('public/slider', $file_name);
          		$gal = new Galery();
          		$gal->file_name = $file_name;
          		$gal->table_name = 'slider';
          		$gal->foreign_id = 0;
          		$gal->created_by = Auth::user()->id;
          		$gal->created_at = now();
          		$gal->save();
              $status=1;
        	}
      	}
  	}
    return back()->with(["status"=>$status,'files_error'=>$files_error]);
  }
}
