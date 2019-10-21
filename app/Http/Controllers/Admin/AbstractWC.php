<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Catalog;
use App\AbstractCat;
use App\Galery;
use DB;
use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AbstractWC extends Controller
{

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

	public function edit($id)
	{
		if($id == 'new'){
			$data = new AbstractCat();
		}
		else {
			$data = AbstractCat::find($id);
		}
		$action = "/bo/asbtract/detail/".$id;
		return view('admin.abstract.abstract-detail', compact('data','action'));
	}
	public function update($id)
	{
		if($id == 'new'){
			$data = new AbstractCat();
		}
		else {
			$data = AbstractCat::find($id);
		}
		$data->title = request('title');
		$data->keywords = request('keywords');
		$data->abstract = request('abstract');
		$data->created_by = Auth::user()->id;
		$data->catalog_id = $this->getCatalogId(request('isbn'));
		$data->save();

		if(!request()->files == "")
		{
			$files = request('files');
			$format = array('jpg','jpeg','png');
			foreach ($files as $file) {
				if ($file->getSize() > 100000000) {
					$files_error++;
				}
				else if (!in_array($file->getClientOriginalExtension(), $format)) {
					$files_error++;
				}else{
					$file_name = Uuid::generate()->string.'.'.$file->getClientOriginalExtension();
					$file->storeAs('public/abstract', $file_name);
					$gal = new Galery();
					$gal->file_name = $file_name;
					$gal->table_name = 'abstract';
					$gal->foreign_id = 0;
					$gal->created_by = Auth::user()->id;
					$gal->created_at = now();
					$gal->save();
					$status=1;
				}
			}
		}
		return redirect('/bo/asbtract/detail/'.$id);
	}
	public function getCatalogId($isbn)
	{
		$catalog = Catalog::whereHas('collections',function($q){
			$q->where('category_id', 4);
		})
		->where(DB::raw("replace(isbn,'-')", "LIKE", "replace('".$isbn."','-')"))
		->first();
		if($catalog){
			return $catalog->id;
		} else {
			return 0;
		}
	
	}
}
