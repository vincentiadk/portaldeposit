<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Event;
use App\Comment;

use App\Galery;
use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class KegiatanWC extends Controller
{
  function agendaView () 
  {
    return view('admin.kegiatan.agenda');
  }

  function agendaTambahView () 
  {
    return view('admin.kegiatan.agenda-detail')->with(["mode"=>"tambah","action"=>"/bo/kegiatan/tambah"]);
  }

  function agendaDetailView ($id) 
  {
    $data = Event::where('id', $id)->first();
    $comment = count(Comment::where('relation_name', 'event')->where('relation_id', $id)->get());
    $gal = Galery::where('foreign_id',$id)->get();
    return view('admin.kegiatan.agenda-detail')->with(["id"=>$id, "data"=>$data,"mode"=>"detail","action"=>"/bo/kegiatan/update", 'comment' => $comment, 'galeries'=>$gal]);
  }

  function agendaUpdate(Request $req) 
  {
    $user = Auth::user();

    $slug = 'event/'.str_replace(' ', '-', strtolower($req->title));

    if (isset($req->simpanpub)) $status = "published";
    else $status = "not published";

    $array_to_input = [
      "type" => $req->type,
      "title" => $req->title,
      "slug" => $slug,
      "date_start" => Carbon::parse($req->date_start)->format('Y-m-d H:i:s'),
      "date_end" => Carbon::parse($req->date_end)->format('Y-m-d H:i:s'),
      "participant" => $req->participant,
      "place" => $req->place,
      "speaker" => $req->speaker,
      "is_comment" => $req->is_comment,
      "description" => $req->description,
      "status" => $status,
      "info" => $req->info,
      "updated_by" => $user->id,
      "updated_at" => now()
    ];

    if ($request->has('delete_id')) {
      unset($req['delete_id']);
    }
    

    $files_error=0;
    $res = Event::where('id', $req['id'])->update($array_to_input);

    if ($res == 0) 
    {
      return back()->with(["status"=>0]);    
    }
    else
    {
      if ($request->has('delete_id')) {
          foreach ($request->delete_id as $did) {
            $file = Galery::find($did);
            if ($file != null) {
              File::delete(storage_path('app/public/event/event'.$file->foreign_id.'/'.$file->file_name));
              $file->delete();
            }
           
          }
      }
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
            }else{
              $file_name = Uuid::generate()->string.'.'.strtolower($file->getClientOriginalExtension());
              $file->storeAs('public/event/event'.$req['id'], $file_name);
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
  }

  function agendaTambah(Request $req) 
  {
    $user = Auth::user();

    $slug = 'event/'.str_replace(' ', '-', strtolower($req->title));
    
    if (isset($req->simpanpub)) $status = "published";
    else $status = "not published";

    $array_to_input = [
      "type" => $req->type,
      "title" => $req->title,
      "slug" => $slug,
      "date_start" => Carbon::parse($req->date_start)->format('Y-m-d H:i:s'),
      "date_end" => Carbon::parse($req->date_end)->format('Y-m-d H:i:s'),
      "speaker" => $req->speaker,
      "is_comment" => $req->is_comment,
      "participant" => $req->participant,
      "place" => $req->place,
      "description" => $req->description,
      "status" => $status,
      "info" => $req->info,
      "created_by" => $user->id,
      "created_at" => now()
    ];

    $result_id = Event::insertGetId($array_to_input);


    $files_error=0;
   if ($result_id != null) 
    {
      
      if($req->hasFile('files'))
      {
          $files = $req->file('files');
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
              $file->storeAs('public/event/event'.$result_id, $file_name);
              $gal = new Galery();
              $gal->file_name = $file_name;
              $gal->table_name = 'event';
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

  function agendaDelete (Request $request) 
  {
    $data = Event::find($request->id);
    if ($data) { 
        Comment::where('relation_name','event')->where('relation_id',$request->id)->delete();
        File::delete(storage_path('app/public/pdf/'.$data->files));
        Galery::where('foreign_id',$request->id)->where('table_name','event')->delete();
        File::delete(storage_path('app/public/event/event'.$request->id));
        $data->delete();
    }
    return redirect('/bo/kegiatan/agenda')->with(["status"=>1]);
  }


}
