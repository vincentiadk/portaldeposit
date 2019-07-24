<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\Publication;
use App\Event;
use App\Rule;
use App\Collection;
use App\Galery;
use App\Catalog;
class HomeController extends Controller
{
  public function homePage()
  {
    $data['news'] = $this->newsNewest();
    $data['koleksi'] = $this->publikasiNewest();
    $data['event'] = $this->eventNewest();
    $data['allgalerys'] = $this->allGalery();
    $data['sliders'] = $this->getSlider();
    
    return view('webpage.home', $data);
	}

  public function faq()
  {
    $data = $this->getFaq();
    return view('webpage.faq')->with(['data' => $data]);
  }
    
  public function tentang()
  {
    $data = $this->getTentang();
    return view('webpage.tentang')->with(['data' => $data]);
  }
  
  public function karir()
  {
    return view('webpage.karir');
  }

  private function newsNewest()
  {
    $data = News::where('status', 'published')->orderby('created_at', 'desc')->take(3)->get();
    return $data;
  } 

  private function publikasiNewest()
  {

 /*  $data = Collection::latest()->where('noinduk_deposit', '!=', null)
    ->whereIn('catalog_id',function($query){
      $query->select('catalogs.id')->from('catalogs')
      ->join('catalog_ruas','catalog_ruas.catalogid','=','catalogs.id')
      ->where('tag','520')->whereRaw('LENGTH(value) > 10 ');
    }
    )->take(12)->get(); */

   $data = Catalog::whereIn('id',function($query){
      $query->select('catalogs.id')->from('catalogs')
      ->join('catalog_ruas','catalog_ruas.catalogid','=','catalogs.id')
      ->join('collections','collections.catalog_id','=','catalogs.id')
      ->where('collections.noinduk_deposit','!=',null)
      ->where('coverurl','!=',null)
      ->where('tag','520')->whereRaw('LENGTH(value) > 10 ');
    })->latest()->take(16)->get();
 
 /* $data = Catalog::whereHas('collections',function($query){
    $query->where('noinduk_deposit','!=',null);
  })->where(function($query){
    $query->select('catalogs')->join('catalog_ruas','catalog_ruas.catalogid','=','catalogs.id')
    ->where('tag','520')->whereRaw('LENGTH(value) > 10 ');
  })
  ->where('coverurl','!=',null)->latest()->take(16)->get();*/
    return $data;
	}

  private function eventNewest()
  {
    $data = Event::where('status', 'published')->where('datetime', '>=', now())->orderby('created_at', 'desc')->take(5)->get();
    return $data;
	}
    
  private function getTentang()
  {
    $data = Rule::where('type', 'tentang')->get();
    return $data;
  }

  private function getFaq()
  {
    $data = Rule::where('type', 'faq')->get();
    return $data;
  }

  private function allGalery(){
    $data = Galery::where('table_name', 'news')->get();

    return $data;
  }

  private function getSlider(){
    $data = Galery::where('table_name', 'slider')->orderby('created_at', 'desc')->take(3)->get();

    return $data;
  }
}

?>
