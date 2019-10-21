<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Catalog;
use App\AbstractCat;
use App\CatalogRuas;
use DB;

class AbstractWC extends Controller
{
    public function listCat()
    {
    	$model = Catalog::select(['id','title','isbn','publisher','publishlocation','publishyear'])
    	->whereHas('collections',function($q){
    		$q->where('category_id',4);
    	})
    	->where('isdelete',0);
    	$dataTable = \DataTables::of($model)
	    	->editColumn('action', function($model){
	    		return "Pick";
	    	})
	    	->editColumn('title', function($model){
	    		if(strlen(trim($model->title)) > 0){
	    			return $model->title;
	    		} else {
	    			$catalog_ruas =  CatalogRuas::where('catalogid',$model->id)->where('tag',245)->first();
	    			if($catalog_ruas){
	    				return $catalog_ruas->value;
	    			} else {
	    				return "";
	    			}
	    			
	    	    }
	    	})
	    	->addColumn('impresum', function($model){
	    		return $model->publisher . $model->publishlocation .$model->publishyear;
	    	})
	    	->addIndexColumn()
	    	->rawColumns(['action']);
    	return $dataTable->make(true);
    }

    public function list()
    {
    	$model = AbstractCat::query();
    	$dataTable = \DataTables::eloquent($model)
    	->editColumn('action',function($model){
    		return "Pick";
    	})
    	->addIndexColumn()
    	->rawColumns(['action']);
    	return $dataTable->make(true);
    }

    public function index()
    {
        return view('admin.abstract.abstract');
    }
     public function indexCat()
    {
        return view('admin.abstract.abstractCat');
    }
}
