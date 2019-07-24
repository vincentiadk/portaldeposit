<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Publication;
use Illuminate\Support\Facades\Auth;

use App\Galery;
use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DepositWC extends Controller
{
  function terbitanDepositView () 
  {
    return view('admin.deposit.terbitan-deposit');
  }

  function terbitanDepositTambahView () 
  {
    return view('admin.deposit.terbitan-deposit-detail')->with(["mode"=>"tambah","action"=>"/bo/deposit/terbitan-deposit/tambah"]);
  }

  function terbitanDepositDetailView ($id) 
  {
    $data = Publication::with('createdBy', 'updatedBy')->where('id', $id)->first();
    $gal = Galery::where('foreign_id',$id)->get();
    return view('admin.deposit.terbitan-deposit-detail')->with(["id"=>$id, 'data'=>$data,"mode"=>"detail","action"=>"/bo/deposit/terbitan-deposit/update", 'galeries'=>$gal]);
  }

  function terbitanDepositUpdate(Request $request) {
    $req=$request->all();
    $req = $this->setup_data($req);
    $req['updated_by'] = Auth::user()->id;
    $req['updated_at'] = now();
    unset($req['files']);
    unset($req['dokumen']);

    

    if ($request->has('delete_id')) {
      unset($req['delete_id']);
    }
    

    $files_error=0;

    if (Publication::where('id', $req['id'])->update($req) == 1) 
    {
      if($request->hasFile('dokumen')){
      $dokumen = $request->dokumen;
      $file_name = Uuid::generate()->string.'.'.strtolower($dokumen->getClientOriginalExtension());
        if (strtolower($dokumen->getClientOriginalExtension())== 'pdf' && $dokumen->getSize()<= 60000000) {
          $dg = Publication::find($req['id']);
          if ($dg->files == null) {
            $dg->files = $file_name;
            $dg->save();
          }else{
            $file_name = $dg->files;
          }
          $dokumen->storeAs('public/pdf', $file_name);
        }
      }

      if ($request->has('delete_id')) {
          foreach ($request->delete_id as $did) {
            $file = Galery::find($did);
            if ($file != null) {
              File::delete(storage_path('app/public/deposit/deposit'.$file->foreign_id.'/'.$file->file_name));
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
              $file->storeAs('public/deposit/deposit'.$req['id'], $file_name);
              $gal = new Galery();
              $gal->file_name = $file_name;
              $gal->table_name = 'publication';
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

  

  function terbitanDepositTambah(Request $request) 
  {
    $req=$request->all();
    $req = $this->setup_data($req);
    unset($req['id']);
    unset($req['files']);
    unset($req['dokumen']);
    $req['created_by'] = Auth::user()->id;
    $req['created_at'] = now();

    
    

   $result_id = Publication::insertGetId($req);
    

    $files_error=0;
   if ($result_id != null) 
    {
      if($request->hasFile('dokumen')){
        $dokumen = $request->dokumen;
        $file_name = Uuid::generate()->string.'.'.strtolower($dokumen->getClientOriginalExtension());
        if (strtolower($dokumen->getClientOriginalExtension())== 'pdf' && $dokumen->getSize()<= 60000000) {
          $dg = Publication::find($result_id);
          $dg->files = $file_name;
          $dg->save();
          $dokumen->storeAs('public/pdf', $file_name);
        }else{
          $files_error++;
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
            }
            else{
              $file_name = Uuid::generate()->string.'.'.strtolower($file->getClientOriginalExtension());
              $file->storeAs('public/deposit/deposit'.$result_id, $file_name);
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

  function terbitanDepositDelete (Request $request) 
  {
    $data = Publication::find($request->id);
    if ($data) { 
        File::delete(storage_path('app/public/pdf/'.$data->files));
        Galery::where('foreign_id',$request->id)->where('table_name','publication')->delete();
        File::delete(storage_path('app/public/deposit/deposit'.$request->id));
        $data->delete();
    }
    return redirect('/bo/deposit/terbitan-deposit')->with(["status"=>1]);
  }

  function setup_data($req){
    if (!empty($req['simpan'])) 
    {
        $req['is_status'] = 'not published';
    }
    else if (!empty($req['simpanpub'])) 
    {
        $req['is_status'] = 'published';
    }
    unset($req['simpan']);
    unset($req['simpanpub']);
    unset($req['_token']);
    return $req;
  }
}
