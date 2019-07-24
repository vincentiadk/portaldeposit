<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\Comment;
use App\Galery;

class KegiatanController extends Controller
{
  	public function kegiatan(Request $request)
  	{
	    if ($request->page == null) $page = 1;
	    else $page = $request->page;

	    if ($request->search == null) $search = "";
	    else $search = $request->search;

	    if ($request->type == null)  $type = "";
	    else $type = $request->type;


	    $data['data'] = $this->getByPage($page,$search,$type);
	    $data['search'] = $search;
    	$data['type'] = $type;
	    $data['count'] = $data['data']->total();
	    $data['page'] = $page;
	    $data['current_page'] = $data['data']->currentPage();
	    $data['last_page'] = $data['data']->lastPage();
	    $data['galery'] = $this->getGalery();
	    $data['allgalery'] = $this->allGalery();
   		return view('webpage.kegiatan', $data);
	}

  	public function detailkegiatan($slug)
  	{
    	$data = $this->getDetailBySlug($slug);
    	$relation_name = "event";
    	$comment = $this->getComment($data->id, $relation_name);
    	$gallery = $this->getGalerys($data->id);
      $otherEvent = $this->eventOther($data->id);
      $allgalery = $this->allGalery();

		return view('webpage.detailkegiatan')->with(['data' => $data, 'comment' => $comment, 'galerys'=>$gallery, 'otherEvent' => $otherEvent, 'allgalerys' => $allgalery]);
	}

	private function getByPage($page, $search, $type)
	{
	    $data = Event::where('status', 'published')->orderBy('date_start', 'desc');
	    if ($type != "") $data->where('type', $type);

	    if ($search != "") {
	      $data->where(function($query) use ($search) {
	          $query->orwhere(DB::Raw('lower(title)'), 'like', '%'.strtolower($search).'%')
	              ->orwhere(DB::Raw('lower(speaker)'), 'like', '%'.strtolower($search).'%');
	      });
	    }
	  
	    return $data->paginate(9);
	}

  private function getDetailBySlug($slug){
  	$newslug = 'event/'.$slug;
    $data = Event::where('slug', $newslug)->first();

    return $data;
  }

  private function getComment($relation_id, $relation_name)
  {
    $data = Comment::where('relation_name', $relation_name)->where('relation_id', $relation_id)->where('status', '1')->get();

    return $data;
  }

  private function getGalery(){
    $data = Galery::where('table_name', 'event')->take(6)->get();

    return $data;
  }

  private function allGalery(){
    $data = Galery::where('table_name', 'event')->get();

    return $data;
  }

  private function getGalerys($id){
    $data = Galery::where('table_name', 'news')->where('foreign_id', $id)->get();

    return $data;
  }

  private function eventOther($id)
  {
    $data = Event::where('status', 'published')->where('id', '!=', $id)->orderby('created_at', 'desc')->take(3)->get();
    return $data;
  } 
}

?>
