<?php

function get_variable()
{
		$data['url_client'] = 'http://deposit.pendidikanberintegritas.org/api';
		$data['url_perpus'] = 'http://192.168.0.58/DepositAPI/api/ ';
		return $data;
}

function getDetailCatalogById($id)
{
		$catalog = App\Catalog::find($id);
		$col = $catalog->collections->where('category_id',4)->first();
		$col->publisher = ($col->publisher_id ? $col->master_publisher->publisher_name : $col->publisher);
		$abstract_="";
		$abstract = $catalog->catalog_ruas->where('tag','520')->first();
		if($abstract){
            if(preg_match('/[$]a(.*?)[$]/',$abstract->value, $match) == 1) {
                $abstract_ = trim($match[1]);
            } else if(preg_match('/[$]a(.*)/', $abstract->value, $match) == 1) {
                 $abstract_ = trim($match[1]);
            }
        }
        $col->isbn = $catalog->isbn;
		$col->abstract = $abstract_;
		return $col;		
}
?>