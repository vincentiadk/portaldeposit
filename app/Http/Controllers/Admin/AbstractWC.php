<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Catalog;
use App\AbstractCat;
use DB;

class AbstractWC extends Controller
{
    public function listCat()
    {
    	$model = Catalog::select(['id','title','isbn','publisher','publishlocation','publishyear'])
    	->whereHas('collections',function($q){
    		$q->where('category_id',4);
    	});
    	$dataTable = \DataTables::of($model)
	    	->editColumn('action', function($model){
	    		return "Pick";
	    	})
	    	->editColumn('title', function($model){
	    		return ($model->title ? $model->title : $model->catalog_ruas->where('tag',245)->first()->value);
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
