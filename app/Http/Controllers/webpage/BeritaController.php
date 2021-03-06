<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\News;
use App\Comment;
use App\Galery;

class BeritaController extends Controller
{
  //view berita
    public function berita(Request $req)
    {
        $newest = News::where('status','published');
        if ($req->type != "") {
           $newest =  $newest->where('type', $req->type);
           $datas['type'] = $req->type;
        } else {
            $datas['type'] = "";
        }
        if ($req->search != "") {
            $newest = $newest->where(DB::raw('lower(title)'), 'like', '%' . strtolower($req->search) . '%');
            $datas['search'] = $req->search;
        } else {
            $datas['search'] = "";
        }
        $newest = $newest->latest()->paginate(5);
        $datas['galery'] = $this->allGalery();
        return view('web.berita',compact('datas','newest'));
    }

  //get newest berita with 10 data
    private function newsNewest(Request $req)
    {
        $data = News::where('status','published');
        if ($req->type != "") $data->where('type', $req->type);
        $data->where(DB::raw('lower(title)'), 'like', '%'.strtolower($req->search).'%');
        $data->latest()->paginate(10);
        return $data;
    }

  //view detail berita
    public function detailberita($slug)
    {
        $data = $this->getBySlug($slug);
        $relation_name = "news";
        $comment = $this->getComment($data->id, $relation_name);
        $gallery = $data->images()->where('table_name','news')->get();//$this->getGalery($data->id);
        $otherNews = $this->newsOther($data->id);
        $allgalery = $this->allGalery();

        return view('web.detailberita')->with(['datas'=>$data, 'comments'=>$comment, 'galerys'=>$gallery, 'otherNews' => $otherNews, 'allgalerys' => $allgalery]);
    }

  //get berita by slug
    private function getBySlug($slug)
    {
        $newslug = 'news/'.$slug;
        $data = News::with('createdBy')->where('slug', $newslug)->where('status', 'published')->first();
        return $data;
    }

  //get comment
    private function getComment($id, $name)
    {
        $data = Comment::where('relation_name', $name)->where('relation_id', $id)->where('status', '1')->get();

        return $data;
    }

  //get all galery that relations with berita
    private function allGalery(){
        $data = Galery::where('table_name', 'news')->get();

        return $data;
    }

  //get galery by once berita
    private function getGalery($id){
        $data = Galery::where('table_name', 'news')->where('foreign_id', $id)->get();
        return $data;
    }

  //get other newest berita
    private function newsOther($id)
    {
        $data = News::where('status', 'published')->where('id', '!=', $id)->orderby('created_at', 'desc')->take(7)->get();
        return $data;
    } 
}

?>
