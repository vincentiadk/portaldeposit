<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group (['middleware' => ['auth']], function () {
  Route::get ('/bo','Admin\DashboardWC@dashboard');

	Route::get ('/logout', 'Admin\AuthWC@logout');

	Route::get ('/bo/berita', 'Admin\BeritaWC@beritaView');
	Route::get ('/bo/berita/tambah', 'Admin\BeritaWC@beritaTambahView');
	Route::post ('/bo/berita/tambah', 'Admin\BeritaWC@beritaTambah');
	Route::get ('/bo/berita/detail/{id}', 'Admin\BeritaWC@beritaDetailView');
	Route::post ('/bo/berita/update', 'Admin\BeritaWC@beritaUpdate');
	Route::post ('/bo/berita/delete', 'Admin\BeritaWC@beritaDelete');

	Route::get ('/bo/pedoman', 'Admin\PedomanWC@PedomanView');
	Route::get ('/bo/pedoman/tambah', 'Admin\PedomanWC@pedomanTambahView');
	Route::post ('/bo/pedoman/tambah', 'Admin\PedomanWC@pedomanTambah');
	Route::get ('/bo/pedoman/detail/{id}', 'Admin\PedomanWC@pedomanDetailView');
	Route::post ('/bo/pedoman/update', 'Admin\PedomanWC@pedomanUpdate');
	Route::post ('/bo/pedoman/delete', 'Admin\PedomanWC@pedomanDelete');

	Route::get ('/bo/deposit/terbitan-deposit', 'Admin\DepositWC@terbitanDepositView');
	Route::get ('/bo/deposit/terbitan-deposit/tambah', 'Admin\DepositWC@terbitanDepositTambahView');
	Route::post ('/bo/deposit/terbitan-deposit/tambah', 'Admin\DepositWC@terbitanDepositTambah');
	Route::get ('/bo/deposit/terbitan-deposit/detail/{id}', 'Admin\DepositWC@terbitanDepositDetailView');
	Route::post ('/bo/deposit/terbitan-deposit/update', 'Admin\DepositWC@terbitanDepositUpdate');
	Route::post ('/bo/deposit/terbitan-deposit/delete', 'Admin\DepositWC@terbitanDepositDelete');

	Route::get ('/bo/kegiatan/agenda', 'Admin\KegiatanWC@agendaView');
	Route::get ('/bo/kegiatan/tambah', 'Admin\KegiatanWC@agendaTambahView');
	Route::post ('/bo/kegiatan/tambah', 'Admin\KegiatanWC@agendaTambah');
	Route::get ('/bo/kegiatan/detail/{id}', 'Admin\KegiatanWC@agendaDetailView');
	Route::post ('/bo/kegiatan/update', 'Admin\KegiatanWC@agendaUpdate');
	Route::post ('/bo/kegiatan/delete', 'Admin\KegiatanWC@agendaDelete');

	Route::get ('/bo/user', 'Admin\UserWC@userView');
	Route::get ('/bo/user/tambah', 'Admin\UserWC@userTambahView');
	Route::post ('/bo/user/tambah', 'Admin\UserWC@userTambah');
	Route::get ('/bo/user/detail/{id}', 'Admin\UserWC@userDetailView');
	Route::post ('/bo/user/update', 'Admin\UserWC@userUpdate');

	Route::get ('/bo/laporan', 'Admin\LaporanWC@laporanView');

	Route::get ('/bo/statistik', 'Admin\StatistikWC@statistikView');

	Route::get('/bo/comment/{type}/{slug}', 'Admin\CommentWC@getComment');

	Route::get('/bo/tentang', 'Admin\TentangWC@tentangView');
	Route::post('/bo/tentang/save', 'Admin\TentangWC@save');

	Route::get ('/bo/faq', 'Admin\FaqWC@faqView');
	Route::get ('/bo/faq/tambah', 'Admin\FaqWC@faqTambahView');
	Route::post ('/bo/faq/tambah', 'Admin\FaqWC@faqTambah');
	Route::get ('/bo/faq/detail/{slug}', 'Admin\FaqWC@faqDetailView');
  	Route::post ('/bo/faq/update', 'Admin\FaqWC@faqUpdate');
  
  	Route::get ('/bo/profile/edit', 'Admin\ProfileWC@editprofile');
  	Route::post ('/bo/profile/update', 'Admin\ProfileWC@updateprofile');

  	Route::get ('/bo/slider', 'Admin\SliderWC@slider');
  	Route::post ('/bo/slider/update', 'Admin\SliderWC@update');

  	Route::get ('/bo/abstract', 'Admin\AbstractWC@index');
  	Route::get ('/bo/abstract/list', 'Admin\AbstractWC@list');
	Route::get ('/bo/abstract/detail/{id}', 'Admin\AbstractWC@edit');
	Route::post ('/bo/abstract/detail/{id}', 'Admin\AbstractWC@update');
	Route::post ('/bo/abstract/delete', 'Admin\AbstractWC@delete');
});




Route::get ('/', 'webpage\HomeController@homePage');
Route::get ('/home', 'webpage\HomeController@homePage');
Route::get ('/news', 'webpage\BeritaController@berita');
Route::get ('/news/{slug}', 'webpage\BeritaController@detailberita');
Route::get ('/wajibserah', 'webpage\WajibserahController@wajibserah');
Route::get ('/wajibserah/detail', 'webpage\WajibserahController@detailwajibserah');
Route::get ('/wajibserah/terbitan/{id}', 'webpage\WajibserahController@terbitan');
Route::get ('/wajibserah/download', 'webpage\WajibserahController@download');
Route::get ('/koleksi', 'webpage\KoleksiController@koleksi');
Route::get ('/detailkoleksi/{id}', 'webpage\KoleksiController@detailkoleksi');
Route::get ('/publication', 'webpage\PublikasiController@publikasi');
Route::get ('/publication/{slug}', 'webpage\PublikasiController@detailpublikasi');
Route::get ('/event', 'webpage\KegiatanController@kegiatan');
Route::get ('/event/{slug}', 'webpage\KegiatanController@detailkegiatan');
Route::get ('/rule', 'webpage\PedomanController@pedoman');
Route::get ('/rule/{slug}', 'webpage\PedomanController@detailpedoman');
Route::get ('/wajibserah/statistik', 'webpage\WajibserahController@statistik');
Route::get ('/koleksi/statistik', 'webpage\KoleksiController@statistik');
Route::get ('/koleksi/download', 'webpage\KoleksiController@download');
Route::get ('/statistik/download', 'webpage\WajibserahController@downloadStatistik');
Route::get ('/faq', 'webpage\HomeController@faq');
Route::get ('/tentang', 'webpage\HomeController@tentang');
Route::get ('/karir', 'webpage\HomeController@karir');
Route::get ('/rule/detailpedoman/{slug}', 'webpage\PedomanController@detailpedoman');
Route::post ('/forgotpassword', 'webpage\UserWC@forgot_password');

Route::get ('/test', 'HomeController@test');


Route::get('/home', 'HomeController@index')->name('home');

Route::post('/comment/submit','webpage\CommentController@submit');