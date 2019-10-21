<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Catalog;
use App\AbstractCat;
use App\Galery;
use App\User;
use DB;
use Uuid;
Use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AbstractWC extends Controller
{

	public function list()
	{
		$model = AbstractCat::query();
		if(Auth::user()->group_id != 0){
			$model->where('created_by', Auth::user()->id);
		}
		$dataTable = \DataTables::eloquent($model)
		->editColumn('action',function($model){
			return "<a href='/bo/abstract/detail/".$model->id."' class='btn btn-xs btn-default btn-edit'><i class='fa fa-edit'></i> Detail</a>";
		})
		->editColumn('created_by',function($model){
			return User::find($model->created_by)->name;
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
		if($id == 'new') {
			$data = new AbstractCat();
		}
		else {
			$data = AbstractCat::find($id);
		}
		$action = "/bo/abstract/detail/".$id;
		return view('admin.abstract.abstract-detail', compact('data','action'));
	}

	public function update($id)
	{
		$req = request()->all();
		$req = $this->setup_data($req);
		if($id == 'new') {
			$data = new AbstractCat();
			$data->created_by = Auth::user()->id;
			
		} else {
			$data = AbstractCat::find($id);
			if($data->isbn != request('isbn')){
				$check_isbn = $this->check_isbn(request('isbn'));
				if($check_isbn[0] == 0 ) {
					return redirect()
					->back()
					->withErrors(['Buku dengan ISBN dimaksud sudah pernah dibuat abstract oleh '.$check_isbn[1]]);
				} 
			}
		}
		if($data->slug == "") {
			$slug = 'abstract/'.str_slug(request('title'), "-");
			$checkLink = $this->checkLink($slug);
			if($checkLink == 0) {
				$data->slug = $slug;
			} else {
				$checkLink ++;
				$data->slug = $slug . "_" . $checkLink;
			}
		}
		$data->title = request('title');
		$data->keywords = request('keywords');
		$data->abstract = request('abstract');
		$data->updated_by = Auth::user()->id;
		if($this->getCatalogId(request('isbn')) != 0){
			$data->catalog_id = $this->getCatalogId(request('isbn'));
		} else {
			return redirect()
			->back()
			->withErrors(['Tidak ditemukan buku dengan ISBN '.request('ISBN'). ' pada database INLIS, mohon cek ISBN yang Anda masukkan.');
		}
		$data->isbn = request('isbn');
		$data->status = $req['status'];
		$data->save();

		if(!request('files') == null )
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
					$gal->foreign_id = $data->id;
					$gal->created_by = Auth::user()->id;
					$gal->created_at = now();
					$gal->save();
					$status = 1;
				}
			}
		}
		return redirect('/bo/abstract/detail/'.$data->id);
	}

	public function getCatalogId($isbn)
	{
		$catalog = Catalog::whereHas('collections',function($q){
			$q->where('category_id', 4);
		})
		->where(DB::raw("replace(isbn,'-')"), "=", DB::raw("replace('".$isbn."','-')"))
		->where('isdelete',0)
		->first();
		if($catalog){
			return $catalog->id;
		} else {
			return 0;
		}

	}
	public function getCatalog($isbn)
	{
		$catalog = Catalog::whereHas('collections',function($q){
			$q->where('category_id', 4);
		})
		->where(DB::raw("replace(isbn,'-')"), "=", DB::raw("replace('".$isbn."','-')"))
		->where('isdelete',0)
		->first();
		if($catalog){
			$check_isbn = $this->check_isbn($isbn);
			if($check_isbn[0] == 0 ) {
				return response()->json('Buku dengan ISBN dimaksud sudah pernah dibuat abstract oleh '.$check_isbn[1]);
			} 
			return response()->json($catalog);
		} else {
			return response()->json("Tidak ditemukan buku dengan ISBN ".$isbn." pada database INLIS, mohon cek ISBN yang Anda masukkan.");
		}
	}

	function setup_data($req)
	{
		if (!empty($req['simpan'])) 
		{
			$req['status'] = 'not published';
		} else if (!empty($req['simpanpub'])) {
			$req['status'] = 'published';
		}
		unset($req['simpan']);
		unset($req['simpanpub']);
		unset($req['_token']);
		return $req;
	}

	function checkLink($link)
	{
		$count = AbstractCat::where("slug",$link)->count();
		return $count;
	}

	function check_isbn($isbn)
	{
		$abstractcat = AbstractCat::where(DB::raw("replace(isbn,'-')"), "=", DB::raw("replace('".$isbn."','-')"))->first();
		if($abstractcat){
			return [0, $abstractcat->createdBy->name]; //sudah ada
		}else {
			return [1, 0]; // belum ada
		}
		
	}
	function delete (Request $request) 
	{
		$data = AbstractCat::find($request->id);
		if ($data) {
			$images = $data->images;
			foreach ($images as $img) {
				File::delete(storage_path('app/public/abstract/'.$img->file_name));
			}
			$data->delete();
		}
		return redirect('/bo/abstract')->with(["status"=>1]);
	}
}
