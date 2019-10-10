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
        $data['depositNewest'] = $this->depositNewest();
        $data['publication']= $this->publication();
        return view('web.home', $data);
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
        $data = News::where('status', 'published')->latest()->take(5)->get();
        return $data;
    } 

    private function publikasiNewest()
    {
        $data = Catalog::whereIn('id',function($query){
            $query->select('catalogs.id')->from('catalogs')
            ->join('catalog_ruas','catalog_ruas.catalogid','=','catalogs.id')
            ->join('collections','collections.catalog_id','=','catalogs.id')
            ->where('collections.noinduk_deposit','!=',null)
            ->where('coverurl','!=',null)
            ->where('tag','520')->whereRaw('LENGTH(value) > 10 ');
        })->latest()->take(16)->get();
        return $data;
    }
    private function depositNewest(){
        $collectionArray = Collection::where('noinduk_deposit','!=',null)
            ->select('catalog_id')
            ->groupby('catalog_id','createdate')
            ->latest()
            ->take(20)
            ->get()
            ->toArray();
        $catIds = array_column($collectionArray,'catalog_id');
        $data = Catalog::whereIn('id',$catIds)->get();
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

    private function allGalery()
    {
        $data = Galery::where('table_name', 'news')->get();

        return $data;
    }

    private function getSlider()
    {
        $data = Galery::where('table_name', 'slider')->orderby('created_at', 'desc')->take(3)->get();

        return $data;
    }

    private function publication()
    {
        $data = Publication::latest()->take(6)->get();
        return $data;
    }
}

?>
