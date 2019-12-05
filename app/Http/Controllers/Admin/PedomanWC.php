<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Rule;

class PedomanWC extends Controller
{
    function pedomanView () 
    {
        return view('admin.pedoman.pedoman');
    }

    function pedomanTambahView () 
    {
        return view('admin.pedoman.pedoman-detail')->with(["mode"=>"tambah","action"=>"/bo/pedoman/tambah"]);
    }

    function pedomanDetailView ($id) 
    {
        $data = Rule::where('id', $id)->first();
        return view('admin.pedoman.pedoman-detail')->with(["id"=>$id, 'data'=>$data,"mode"=>"detail","action"=>"/bo/pedoman/update"]);
    }

    function pedomanUpdate(Request $req) 
    {
        $user = Auth::user();

        $slug = 'rule/'.str_replace(' ', '-', strtolower($req->title));

        if (isset($req->simpanpub)) $status = "published";
        else $status = "not published";

        $array_to_input = [
            "type" => $req->type,
            "title" => $req->title,
            "slug" => $slug,
            "datetime" => now(),
            "is_comment" => $req->is_comment,
            "description" => $req->description,
            "status" => $status,
            "updated_by" => $user->id,
            "updated_at" => now()
        ];

        if($req->hasFile('dokumen')){
            $dokumen = $req->dokumen;
            $file_name = Uuid::generate()->string.'.'.strtolower($dokumen->getClientOriginalExtension());
            if (strtolower($dokumen->getClientOriginalExtension())== 'pdf' && $dokumen->getSize()<= 60000000) {
                $oldName = Rule::find($req['id'])->files;
                if ($oldName == null) {
                    $array_to_input['files']=$file_name;

                }else{
                    $file_name = $oldName;
                }
                $dokumen->storeAs('public/pdf', $file_name);
            }
        }

        $res = Rule::where('id', $req['id'])->update($array_to_input);

        if ($res == 0) {
            return back()->with(["status"=>0]);    
        }  else {
            if($req->hasFile('dokumen')){
                $dokumen = $req->dokumen;
                $file_name = Uuid::generate()->string.'.'.strtolower($dokumen->getClientOriginalExtension());
                if (strtolower($dokumen->getClientOriginalExtension())== 'pdf' && $dokumen->getSize()<= 60000000) {
                    $dg = Rule::find($req['id']);
                    if ($dg->files == null) {
                        $dg->files = $file_name;
                        $dg->save();
                    } else {
                        $file_name = $dg->files;
                    }
                    $dokumen->storeAs('public/pdf', $file_name);
                }
            }
            return back()->with(["status"=>1]);
        }   
    }

    function pedomanTambah(Request $req) 
    {
        $user = Auth::user();

        $slug = 'rule/'.str_replace(' ', '-', strtolower($req->title));

        if (isset($req->simpanpub)) $status = "published";
        else $status = "not published";

        $array_to_input = [
            "type" => $req->type,
            "title" => $req->title,
            "slug" => $slug,
            "datetime" => now(),
            "is_comment" => $req->is_comment,
            "description" => $req->description,
            "status" => $status,
            "created_by" => $user->id,
            "created_at" => now()
        ];





        $data["id"] = Rule::insertGetId($array_to_input);

        if ($data["id"] != null) {
            if($req->hasFile('dokumen')){ 
                $dokumen = $req->dokumen;
                $file_name = Uuid::generate()->string.'.'.strtolower($dokumen->getClientOriginalExtension());
                if (strtolower($dokumen->getClientOriginalExtension())== 'pdf' && $dokumen->getSize()<= 60000000) {
                    $dg = Rule::find($data["id"] );
                    $dg->files = $file_name;
                    $dg->save();
                    $dokumen->storeAs('public/pdf', $file_name);
                }
            }
            return back()->with(["status"=>1]);    
        }  else {
            return back()->with(["status"=>0]);
        }
    }

    function pedomanDelete (Request $request) 
    {
        $data = Rule::find($request->id);
        if ($data) { 
            File::delete(storage_path('app/public/pdf/'.$data->files));
            $data->delete();

        }
        return redirect('/bo/pedoman')->with(["status"=>1]);
    }
}
