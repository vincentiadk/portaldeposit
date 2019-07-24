<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Rule;

class FaqWC extends Controller
{
  function faqView () 
  {
    return view('admin.faq.faq');
  }

  function faqTambahView () 
  {
    return view('admin.faq.faq-detail')->with(["mode"=>"tambah","action"=>"/bo/faq/tambah"]);
  }

  function faqDetailView ($id) 
  {
    $data = Rule::with('createdBy', 'updatedBy')->where('id', $id)->first();
    return view('admin.faq.faq-detail')->with(["id"=>$id, 'data'=>$data,"mode"=>"detail","action"=>"/bo/faq/update"]);
  }

  function faqUpdate(Request $req) 
  {
    $user = Auth::user();

    $slug = 'rule/'.str_replace(' ', '-', strtolower($req->title));

    if (isset($req->simpanpub)) $status = "published";
    else $status = "not published";

    $array_to_input = [
      "title" => $req->title,
      "slug" => $slug,
      "description" => $req->description,
      "updated_by" => $user->id,
      "updated_at" => now()
    ];

    $res = Rule::where('id', $req['id'])->update($array_to_input);

    if ($res == 0) 
    {
      return back()->with(["status"=>0]);    
    }
    else
    {
      return back()->with(["status"=>1]);
    }   
  }

  function faqTambah(Request $req) {
    $user = Auth::user();

    $slug = 'rule/'.str_replace(' ', '-', strtolower($req->title));

    $array_to_input = [
      "type" => "faq",
      "title" => $req->title,
      "slug" => $slug,
      "datetime" => now(),
      "is_comment" => 1,
      "description" => $req->description,
      "status" => "published",
      "created_by" => $user->id,
      "created_at" => now()
    ];

    $data["id"] = Rule::insertGetId($array_to_input);

    if ($data["id"] != null) 
    {
      return back()->with(["status"=>1]);    
    }
    else
    {
      return back()->with(["status"=>0]);
    }
  }
}
