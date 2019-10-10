<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Excel;

use App\Master_publisher;
use App\Collection;
use App\Propinsi;
use App\Catalog;
class WajibserahController extends Controller
{
  public function wajibserah(Request $request)
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
     if ($request->propinsi == null) 
    {
      $propinsi = "";
    }
    else
    {
      $propinsi = $request->propinsi;
    }
    $data['data'] = $this->getByPage($page,$search,$type,$propinsi);
    $data['search'] = $search;
    $data['type'] = $type;
    $data['propinsi'] = $propinsi;
    $data['count'] = $data['data']->total();
    $data['page'] = $page;
    $data['current_page'] = $data['data']->currentPage();
    $data['last_page'] = $data['data']->lastPage();
    $data['kolprop'] = $this->getCountByProvinsi();
    $data['props'] = $this->getPropinsi();

    return view('web.wajibserah', $data);
  }
  
  public function detailwajibserah(Request $request)
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

    if ($request->id == null) 
    {
      $id = "";
    }
    else
    {
      $id = $request->id;
    }

    $data['data'] = $this->getCollection($page,$search,$id);
    $data['search'] = $search;
    $data['id'] = $id;
    $data['count'] = $data['data']->total();
    $data['page'] = $page;
    $data['current_page'] = $data['data']->currentPage();
    $data['last_page'] = $data['data']->lastPage();
    $data['detail'] = $this->getDetail($id);
    $data['total'] = $this->getTotal($id);
  //  dd($request->all());die();
    return view('webpage.detailwajibserah', $data);
  }

  public function terbitan($id)
  {
    $data['data'] = $this->getCollectionById($id);

    return view ('webpage.terbitan', $data);
  }

  public function statistik(Request $req)
  {
    $fromDate = now()->startOfYear()->toDateString();
    $toDate = now()->toDateString();
    $type = 'publisher';
    if ($req->has('fromDate') &&$req->has('toDate')) {
      $fromDate = $req->fromDate;
      $toDate = $req->toDate;
    }
    if ($req->has('type')) {if ($req->type == 'region') {
          $data = $this->getStatistikRegion($fromDate,$toDate);
          $type = 'region';
        }else{
          $data = $this->getStatistikTypePublisher($fromDate,$toDate);
          $type = 'publisher';
        }
    }else {
        $data = $this->getStatistikTypePublisher($fromDate,$toDate);
        $type = 'publisher';
    }
    return view('webpage.statistik')->with(['data'=>$data,'fromDate'=>$fromDate,'toDate'=>$toDate,'type'=>$type]);
  }

  private function getStatistikTypePublisher($fromDate,$toDate){
    $result = DB::select("select mp.TYPE_OF_PUBLISHER label, COUNT(mp.PUBLISHER_ID) total from MASTER_PUBLISHER mp GROUP BY mp.TYPE_OF_PUBLISHER");
      $label = DB::select('select distinct TYPE_OF_PUBLISHER label from MASTER_PUBLISHER');
      $data = $label;
      foreach ($label as $key => $value) {
        $data[$key]->total = 0;
        foreach ($result as $key1 => $value1) {
          if ($value->label == $value1->label) {
            $data[$key]->total = $value1->total;
          }
        }
      }
    return $data;
  }

  private function getStatistikRegion($fromDate,$toDate){
    $result = DB::select("select p.NAMAPROPINSI label, COUNT(m.PUBLISHER_ID) total from master_publisher m INNER JOIN PROPINSI p on p.code = m.region GROUP BY p.NAMAPROPINSI");
      $label = DB::select('select NAMAPROPINSI label from propinsi order by code');
      $data = $label;
      foreach ($label as $key => $value) {
        $data[$key]->total = 0;
        foreach ($result as $key1 => $value1) {
          if ($value->label == $value1->label) {
            $data[$key]->total = $value1->total;
          }
        }
      }
      return $data;
  }

  public function download(Request $request){
     $publish = Master_publisher::find($request->ids);
     $datas = $this->getDownloadPage(1, $request->year, $request->month, $request->ids, $request->type);
      $data = $datas->items();

      if ($request->type == "all") $title = "Seluruh Wajib Serah";
      else if($request->type == "filter") $title = $request->month .'-'.$request->year;

      Excel::create('Daftar Terbitan - '.$publish->publisher_name.'-'. $title, function($excel) use ($data) {
          $excel->sheet('Sheet 1', function($sheet) use ($data) {
              $data['data'] = $data;
              $sheet->loadView('webpage.download', $data);

              return view('webpage.download', $data);
          });
      })->export('xls'); 
   /*    Excel::create('Daftar Terbitan - '.$publish->publisher_name.'-'. $title, function($excel) use ($datas) {
        $i = 1;
        $datas->chunk(500)->map(function($items) use ($excel,$i){
          $excel->sheet('Sheet '.$i, function($sheet) use ($items) {
              $data['data'] = $items;
              $sheet->loadView('webpage.download', $data);
              return view('webpage.download', $data);
             
          });
          $i++;
        });
         
      })->export('xls'); */

  }

  private function getCountByProvinsi(){
   /* $result = DB::select("select * from (select p.NAMAPROPINSI label, COUNT(c.PUBLISHER_ID) total from COLLECTIONS c INNER JOIN master_publisher m on m.publisher_id=c.publisher_id INNER JOIN PROPINSI p on p.code = m.region where c.NOINDUK_DEPOSIT is not null GROUP BY p.NAMAPROPINSI order by COUNT(c.PUBLISHER_ID) desc) mr where rownum <= 5 order by rownum");*/
 //  $result = DB::select("select * from (select p.NAMAPROPINSI label, COUNT(m.PUBLISHER_ID) total, p.code  from MASTER_PUBLISHER m INNER JOIN PROPINSI p on p.code = m.region GROUP BY p.NAMAPROPINSI, p.code order by COUNT(m.PUBLISHER_ID) desc) mr where rownum <= 5 order by rownum");
     $result = DB::select("select * from (select p.NAMAPROPINSI label, COUNT(m.PUBLISHER_ID) total, p.code  from MASTER_PUBLISHER m INNER JOIN PROPINSI p on p.code = m.region GROUP BY p.NAMAPROPINSI, p.code order by COUNT(m.PUBLISHER_ID) desc) mr order by code");
      return $result;
  }

  private function getDownloadPage($currentPage, $year, $month, $id, $type){
    Paginator::currentPageResolver(function () use ($currentPage) {
        return $currentPage;
    });

    if ($type == "all") {
      $data = Collection::where('publisher_id', '=', $id)
                        ->where('noinduk_deposit', '!=', null);
    }
    else if ($type == "filter") {
      $data = Collection::whereYear('createdate', '=', $year)
                        ->whereMonth('createdate', '=', $month)
                        ->where('publisher_id', '=', $id)
                        ->where('noinduk_deposit', '!=', null);
    }
    return $data->paginate(10000);
  }

  public function downloadStatistik(Request $request){

    //  $data = $this->getDownloadStatistikPage(1, $request->fromDate, $request->toDate,$request->type);
      $data = $this->statistik($request)->data;
     // $data = $datas->items();
      Excel::create('Statistik - '.$request->type.'-'. $request->fromDate.'-'.$request->toDate, function($excel) use ($data) {
          $excel->sheet('Sheet 1', function($sheet) use ($data) {
              $data['data'] = $data;
              $sheet->loadView('webpage.downloadStatistik', $data);

              return view('webpage.downloadStatistik', $data);
          });
      })->export('xls'); 
  }
  private function getDownloadStatistikPage($currentPage, $fromDate, $toDate, $type){
    Paginator::currentPageResolver(function () use ($currentPage) {
        return $currentPage;
    });
    switch($type){
      case "region": {
        $data = $this->getStatistikRegion($fromDate,$toDate);}
       break;
      case "publisher": {
        $data = $this->getStatistikTypePublisher($fromDate,$toDate);
      }
      break;
      case "worksheet": {
        $data = $this->getStatistikWorksheet($fromDate,$toDate);
      }
      break;
      default:break;
    }
    
    return $data;
  }
  private function getByPage($page, $search, $type, $propinsi){
     $data = Master_publisher::query();
     if($propinsi!=""){
     $data->where('region','=',$propinsi);
   }
   if($type!=""){
     $data->where(DB::raw('lower(type_of_publisher)'),strtolower($type));
   }
   if($search!=""){
     $data->where(DB::raw('lower(publisher_name)'),'LIKE',strtolower('%'.$search.'%'));
   }
    return $data->paginate(24)->appends(\Request::only(['search','type','propinsi','page']))->setPath('');
  }

  private function getCollection($page, $search, $id){
     $data = Catalog::whereHas('collections',function($query) use($id){
        $query->where('noinduk_deposit','!=',null)->where('publisher_id',$id);
      })->latest();
  /*  if ($id != ""){
      $data->whereHas('master_publisher', function($query) use($id){
        $query->where('publisher_id', $id);
      });
    }
*/
    if ($search != "") {
        $data->where(function($query) use ($search) {
            $query->orwhere(DB::Raw('lower(title)'), 'like', '%'.strtolower($search).'%');
        });
    }

    return $data->paginate(12)->appends(\Request::only(['page','search','id']))->setPath('');
  }

  private function getDetail($id){
    $data = Master_publisher::where('publisher_id', $id)->first();

    return $data;
  }

  private function getCollectionById($id){
    $data = Catalog::find($id);

    return $data;
  }

  private function getTotal($id){
    $data = Collection::where('publisher_id',$id)->where('noinduk_deposit', '!=', null)->paginate(1);

    $total = $data->total();
    return $total;
  }

  private function getPropinsi(){
    $data = Propinsi::all();

    return $data;
  }
}
