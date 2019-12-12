<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\Comment;
use App\Galery;
use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BeritaWC extends Controller
{
  function beritaView () 
  {
    return view('admin.berita.berita');
  }

  function beritaTambahView () 
  {
    return view('admin.berita.berita-detail')->with(["mode"=>"tambah","action"=>"/bo/berita/tambah"]);
  }

  function beritaDetailView ($id) 
  {
    $data = News::where('id', $id)->first();
    $comment = count(Comment::where('relation_name', 'news')->where('relation_id', $id)->get());
    $gal = Galery::where('foreign_id',$id)->get();
    return view('admin.berita.berita-detail')->with(["id"=>$id, 'data'=>$data,"mode"=>"detail","action"=>"/bo/berita/update", 'comment' => $comment, 'galeries'=>$gal]);
  }

  function beritaUpdate(Request $request) 
  {
    $req=$request->all();
    $slug = 'news/'.str_replace(' ', '-', strtolower($req['title']));
    $req = $this->setup_data($req);

    $req['slug'] = $slug;
    $req['updated_by'] = Auth::user()->id;
    $req['updated_at'] = now();
    
    unset($req['files']);

    if ($request->has('delete_id')) {
      unset($req['delete_id']);
    }
    

    $files_error=0;
    if (News::where('id', $req['id'])->update($req) == 1) 
    { 

      if ($request->has('delete_id')) {
          foreach ($request->delete_id as $did) {
            $file = Galery::find($did);
            if ($file != null) {
              File::delete(storage_path('app/public/berita/berita'.$file->foreign_id.'/'.$file->file_name));
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
            else if (!in_array(strtolower($file->getClientOriginalExtension()), $format)) {
                $files_error++;
            }else{
              $file_name = Uuid::generate()->string.'.'.strtolower($file->getClientOriginalExtension());
              $file->storeAs('public/berita/berita'.$req['id'], $file_name);
              $gal = new Galery();
              $gal->file_name = $file_name;
              $gal->table_name = 'news';
              $gal->foreign_id = $req['id'];
              $gal->created_by = Auth::user()->id;
              $gal->created_at = now();
              $gal->save();
            }
          }
      }
      return back()->with(["status"=>1,'files_error'=>$files_error]);  
    }
    else
    {
      return back()->with("status",0);
    }
  }

  function beritaTambah(Request $request) 
  {
    $req=$request->all();
    $slug = 'news/'.str_replace(' ', '-', strtolower($req['title']));
    $req = $this->setup_data($req);
    unset($req['id']);
    unset($req['files']);
    $req['slug'] = $slug;
    $req['created_by'] = Auth::user()->id;
    $req['updated_by'] = Auth::user()->id;
    $result_id = News::insertGetId($req);


    $files_error=0;
   if ($result_id != null) 
    {
      
      if($request->hasFile('files'))
      {
          $files = $request->file('files');
          $format = array('jpg','jpeg','png');
          foreach ($files as $file) {
            if ($file->getSize()> 10000000) {
              $files_error++;
            }
            else if (!in_array(strtolower($file->getClientOriginalExtension()), $format)) {
                $files_error++;
            }
            else{
              $file_name = Uuid::generate()->string.'.'.strtolower($file->getClientOriginalExtension());
              $file->storeAs('public/berita/berita'.$result_id, $file_name);
              $gal = new Galery();
              $gal->file_name = $file_name;
              $gal->table_name = 'news';
              $gal->foreign_id = $result_id;
              $gal->created_by = Auth::user()->id;
              $gal->created_at = now();
              $gal->save();
            }
          }
      }

      return back()->with(["status"=>1,'files_error'=>$files_error]);
    }
    else
    {
      return back()->with("status",0);
    }
  }

  function setup_data($req){
    if (!empty($req['simpan'])) 
    {
        $req['status'] = 'not published';
    }
    else if (!empty($req['simpanpub'])) 
    {
        $req['status'] = 'published';
    }
    unset($req['simpan']);
    unset($req['simpanpub']);
    unset($req['_token']);
    return $req;
  }

  function beritaDelete (Request $request) 
  {
    $data = News::find($request->id);
    if ($data) { 
        Comment::where('relation_name','news')->where('relation_id',$request->id)->delete();
        Galery::where('foreign_id',$request->id)->where('table_name','news')->delete();
        File::delete(storage_path('app/public/berita/berita'.$request->id));
        $data->delete();
    }
    return redirect('/bo/berita')->with(["status"=>1]);
  }

}
