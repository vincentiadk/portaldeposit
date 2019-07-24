<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Publication;
use App\Galery;

class PublikasiController extends Controller
{
  public function publikasi(Request $request)
  {
    if ($request->page == null) 
    {
      $page = 1;
    }
    else
    {
      $page = $request->page;
    }

    if ($request->search == null) 
    {
      $search = "";
    }
    else
    {
      $search = $request->search;
    }

    if ($request->type == null) 
    {
      $type = "";
    }
    else
    {
      $type = $request->type;
    }

    $data['data'] = $this->getByPage($page,$search,$type);
    $data['search'] = $search;
    $data['type'] = $type;
    $data['count'] = $data['data']->total();
    $data['page'] = $page;
    $data['current_page'] = $data['data']->currentPage();
    $data['last_page'] = $data['data']->lastPage();
    $data['allgalerys'] = $this->allGalery();
    // dd(count($data['allgalery']));

    return view('webpage.publikasi', $data);
	}

  public function detailpublikasi($id)
  {
    $data = $this->getDetailById($id);
    if ($data == null) return redirect('/publication');
    $gallery = $this->getGalerys($data->id);

    return view('webpage.detailpublikasi')->with(['data' => $data, 'galerys'=>$gallery]);
  }

  private function getByPage($page, $search, $type)
  {
    $data = Publication::where('is_status', 'published')->orderBy('created_at', 'desc');
    if ($type != "") $data->where('type', $type);

    if ($search != "") {
      $data->where(function($query) use ($search) {
          $query->orwhere(DB::Raw('lower(title)'), 'like', '%'.strtolower($search).'%')
              ->orwhere(DB::Raw('lower(author)'), 'like', '%'.strtolower($search).'%')
              ->orwhere(DB::Raw('lower(publisher)'), 'like', '%'.mb_strtolower($search).'%');
      });
    }
  
    return $data->paginate(16);
  }

  private function getDetailById($id){
    $data = Publication::where('id', $id)->where('is_status', 'published')->first();

    return $data;
  }

  private function allGalery(){
    $data = Galery::where('table_name', 'publication')->get();

    return $data;
  }

  private function getGalerys($id){
    $data = Galery::where('table_name', 'publication')->where('foreign_id', $id)->first();

    return $data;
  }
}
