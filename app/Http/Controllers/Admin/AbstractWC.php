<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class AbstractWC extends Controller
{
    public function listCatalog()
    {
    	$model = Catalog::whereHas('collections',function($query){
    		$query->where('category_id',4);
    	});
    	$dataTable = \DataTables::eloquent($model)
	    	->editColumn('action', function($model){
	    		return "Pick";
	    	})
	    	->addIndexColumn()
	    	->rawColumns(['action']);
    	return $dataTable->make(true);
    }

    public function list()
    {
    	$model = Abstract::query();
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

}
