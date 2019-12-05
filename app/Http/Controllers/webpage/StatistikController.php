<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatistikController extends Controller
{
    public function index()
    {
    	$totws = Master_publisher::count();
        $totcol = Collection::where('category_id',4)->count();
        $totcat = Collection::where('category_id',4)->distinct()->count('catalog_id');

    }
}
