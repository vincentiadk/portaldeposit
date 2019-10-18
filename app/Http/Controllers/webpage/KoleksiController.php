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
use App\Catalog;
class KoleksiController extends Controller
{
    public function koleksi(Request $request)
    {
        if ($request->page == null) {
            $page = 1;
        } else {
            $page = $request->page;
        }

        if ($request->search == null) {
            $search = "";
        } else {
            $search = $request->search;
        }

        if ($request->type == null) {
            $type = "";
        } else {
            $type = $request->type;
        }
    //   var_dump($request->query('page'));die();

        $data['data'] = $this->getByPage($request);

        $data['search'] = $search;
        $data['type'] = $type;
        $data['count'] = $data['data']->total();
        $data['page'] = $page; 
        $data['current_page'] = $data['data']->currentPage(); 
        $data['last_page'] = $data['data']->lastPage();

        return view('web.koleksi', $data);
    }

    public function detailkoleksi($id)
    {
        return view('web.detailkoleksi');
    }

    private function getByPage(Request $request)
    {
        $type = request('type'); $search = request('search');
        $data = Catalog::whereHas('collections',function($query,$type,$search) {
            $query->join('master_publisher','master_publisher.publisher_id','collections.publisher_id')
                    ->where('category_id',4);
            if($type != "") {
                $query->where('type_of_publisher', $type);
            }
            if($type != ""){
                $query->orwhere(DB::Raw('lower(collections.title)'), 'like', '%'.strtolower($search).'%');
            }
        });
        
       /* if (request('type') != ""){
            $data->whereHas('master_publisher', function($query) use($type){
                $query->where('type_of_publisher', $type);
            });
        }

       
        if ($search != "") {
            $data->where(function($query) use ($search) {
                $query->orwhere(DB::Raw('lower(title)'), 'like', '%'.strtolower($search).'%');
            });
        } */

        return $data->paginate(16)->appends(\Request::only(['search','type']))->setPath('');
    }

    public function statistik(Request $req)
    {
        $fromDate = now()->startOfYear()->toDateString();
        $toDate = now()->toDateString();
        $type = 'publisher';
        if ($req->has('fromDate') && $req->has('toDate')) {
            $fromDate = $req->fromDate;
            $toDate = $req->toDate;
        }
        if ($req->has('type')) {
            if ($req->type == 'worksheet') {
                $data = $this->getStatistikWorksheet($fromDate,$toDate);
                $type = 'worksheet';
            }else if ($req->type == 'region') {
                $data = $this->getStatistikRegion($fromDate,$toDate);
                $type = 'region';
            }else{
                $data = $this->getStatistikTypePublisher($fromDate,$toDate);
                $type = 'publisher';
            }
        } else {
            $data = $this->getStatistikTypePublisher($fromDate,$toDate);
            $type = 'publisher';
        }
        return view('webpage.statistikkoleksi')->with(['data'=>$data,'fromDate'=>$fromDate,'toDate'=>$toDate,'type'=>$type]);
    }
    public function download(Request $request){
        $data = $this->statistik($request)->data;
        if ($request->type == "all") $title = "Seluruh Terbitan";
        else if($request->type == "filter") $title = $request->month .'-'.$request->year;

        Excel::create('Daftar Terbitan', function($excel) use ($data) {
            $excel->sheet('Sheet 1', function($sheet) use ($data) {
                $data['data'] = $data;
                $sheet->loadView('webpage.downloadstatistik', $data);

                return view('webpage.downloadstatistik', $data);
            });
        })->export('xls'); 
    }
    private function getStatistikTypePublisher($fromDate,$toDate){
        $result = DB::select("select mp.TYPE_OF_PUBLISHER label, COUNT(c.PUBLISHER_ID) total from COLLECTIONS c INNER JOIN MASTER_PUBLISHER mp on mp.PUBLISHER_ID = c.PUBLISHER_ID where c.CREATEDATE BETWEEN TO_DATE('$fromDate' ,'yyyy/mm/dd hh24:mi:ss') AND TO_DATE('$toDate 23:59:59' ,'yyyy/mm/dd hh24:mi:ss') and c.NOINDUK_DEPOSIT is not null GROUP BY mp.TYPE_OF_PUBLISHER");
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
        $result = DB::select("select p.NAMAPROPINSI label, COUNT(c.PUBLISHER_ID) total from COLLECTIONS c INNER JOIN master_publisher m on m.publisher_id=c.publisher_id INNER JOIN PROPINSI p on p.code = m.region where c.CREATEDATE BETWEEN TO_DATE('$fromDate' ,'yyyy/mm/dd hh24:mi:ss') AND TO_DATE('$toDate 23:59:59' ,'yyyy/mm/dd hh24:mi:ss') and c.NOINDUK_DEPOSIT is not null GROUP BY p.NAMAPROPINSI");
        $label = DB::select('select distinct NAMAPROPINSI label from PROPINSI');
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

    private function getStatistikWorksheet($fromDate,$toDate){
        $result = DB::select("select w.NAME label, COUNT(c.PUBLISHER_ID) total from COLLECTIONS c INNER JOIN WORKSHEETS w on w.ID = c.WORKSHEET_ID where c.CREATEDATE BETWEEN TO_DATE('$fromDate' ,'yyyy/mm/dd hh24:mi:ss') AND TO_DATE('$toDate 23:59:59' ,'yyyy/mm/dd hh24:mi:ss') and c.NOINDUK_DEPOSIT is not null GROUP BY w.NAME");
        $label = DB::select('select distinct NAME label from WORKSHEETS');
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
    //  return $result;
    }
}
