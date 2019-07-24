<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post ('login', 'API\UserController@login');
Route::post ('register', 'API\UserController@register');


	Route::prefix ('user')->group (function() {
		Route::get ('getList', 'API\UserController@getList');
		Route::post ('detail', 'API\UserController@detail');
		Route::get ('getAll', 'API\UserController@getAll');
		Route::get ('getById', 'API\UserController@getById');
		Route::post ('save', 'API\UserController@save');
		Route::post ('updateById', 'API\UserController@updateById');
		Route::post ('deleteById', 'API\UserController@deleteById');
		Route::get ('getCount', 'API\UserController@getCount');
	});

	Route::prefix ('activity')->group (function(){
		Route::get ('getList', 'API\ActivityController@getList');
		Route::get ('getAll', 'API\ActivityController@getAll');
		Route::get ('getById', 'API\ActivityController@getById');
		Route::get ('getByCreatedId', 'API\ActivityController@getByCreatedId');
		Route::post ('save', 'API\ActivityController@save');
		Route::post ('updateById', 'API\ActivityController@updateById');
		Route::post ('deleteById', 'API\ActivityController@deleteById');
		Route::get ('getCount', 'API\ActivityController@getCount');
	});

	Route::prefix ('config')->group (function(){
		Route::get ('getAll', 'API\ConfigController@getAll');
		Route::get ('getById', 'API\ConfigController@getById');
		Route::get ('getByCreatedId', 'API\ConfigController@getByCreatedId');
		Route::post ('save', 'API\ConfigController@save');
		Route::post ('updateById', 'API\ConfigController@updateById');
		Route::post ('deleteById', 'API\ConfigController@deleteById');
	});

	Route::prefix ('event')->group (function(){
		Route::get ('getList', 'API\EventController@getList');
		Route::get ('getAll', 'API\EventController@getAll');
		Route::get ('getById', 'API\EventController@getById');
		Route::get ('getByCreatedId', 'API\EventController@getByCreatedId');
		Route::post ('save', 'API\EventController@save');
		Route::post ('updateById', 'API\EventController@updateById');
		Route::post ('deleteById', 'API\EventController@deleteById');
		Route::get ('getCount', 'API\EventController@getCount');
	});

	Route::prefix ('galery')->group (function(){
		Route::get ('getAll', 'API\GaleryController@getAll');
		Route::get ('getById', 'API\GaleryController@getById');
		Route::get ('getByCreatedId', 'API\GaleryController@getByCreatedId');
		Route::post ('save', 'API\GaleryController@save');
		Route::post ('updateById', 'API\GaleryController@updateById');
		Route::post ('deleteById', 'API\GaleryController@deleteById');
	});

	Route::prefix ('group')->group (function(){
		Route::get ('getAll', 'API\GroupController@getAll');
		Route::get ('getById', 'API\GroupController@getById');
		Route::get ('getByCreatedId', 'API\GroupController@getByCreatedId');
		Route::post ('save', 'API\GroupController@save');
		Route::post ('updateById', 'API\GroupController@updateById');
		Route::post ('deleteById', 'API\GroupController@deleteById');
	});

	Route::prefix ('media')->group (function(){
		Route::get ('getAll', 'API\MediaController@getAll');
		Route::get ('getById', 'API\MediaController@getById');
		Route::get ('getByCreatedId', 'API\MediaController@getByCreatedId');
		Route::post ('save', 'API\MediaController@save');
		Route::post ('updateById', 'API\MediaController@updateById');
		Route::post ('deleteById', 'API\MediaController@deleteById');
	});

	Route::prefix ('news')->group (function(){
		Route::get ('getList', 'API\NewsController@getList');
		Route::get ('getAll', 'API\NewsController@getAll');
		Route::get ('getByCreatedId', 'API\NewsController@getByCreatedId');
		Route::post ('save', 'API\NewsController@save');
		Route::post ('updateById', 'API\NewsController@updateById');
		Route::post ('deleteById', 'API\NewsController@deleteById');
		Route::get ('getCount', 'API\NewsController@getCount');
	});

	Route::prefix ('page')->group (function(){
		Route::get ('getList', 'API\PageController@getList');
		Route::get ('getAll', 'API\PageController@getAll');
		Route::get ('getById', 'API\PageController@getById');
		Route::get ('getByCreatedId', 'API\PageController@getByCreatedId');
		Route::post ('save', 'API\PageController@save');
		Route::post ('updateById', 'API\PageController@updateById');
		Route::post ('deleteById', 'API\PageController@deleteById');
		Route::get ('getCount', 'API\PageController@getCount');
	});

	Route::prefix ('pgroup')->group (function(){
		Route::get ('getAll', 'API\PgroupController@getAll');
		Route::get ('getById', 'API\PgroupController@getById');
		Route::get ('getByCreatedId', 'API\PgroupController@getByCreatedId');
		Route::post ('save', 'API\PgroupController@save');
		Route::post ('updateById', 'API\PgroupController@updateById');
		Route::post ('deleteById', 'API\PgroupController@deleteById');
		Route::get ('getCount', 'API\PgroupController@getCount');
	});

	Route::prefix ('publication')->group (function(){
		Route::get ('getList', 'API\PublicationController@getList');
		Route::get ('getAll', 'API\PublicationController@getAll');
		Route::get ('getById', 'API\PublicationController@getById');
		Route::get ('getByCreatedId', 'API\PublicationController@getByCreatedId');
		Route::post ('save', 'API\PublicationController@save');
		Route::post ('updateById', 'API\PublicationController@updateById');
		Route::post ('deleteById', 'API\PublicationController@deleteById');
		Route::get ('getCount', 'API\PublicationController@getCount');
		Route::get ('image', 'API\PublicationController@image');
	});

	Route::prefix ('region')->group (function(){
		Route::get ('getAll', 'API\RegionController@getAll');
		Route::get ('getById', 'API\RegionController@getById');
		Route::get ('getByCreatedId', 'API\RegionController@getByCreatedId');
		Route::post ('save', 'API\RegionController@save');
		Route::post ('updateById', 'API\RegionController@updateById');
		Route::post ('deleteById', 'API\RegionController@deleteById');
	});

	Route::prefix ('rule')->group (function(){
		Route::get ('getList', 'API\RuleController@getList');
		Route::get ('getById', 'API\RuleController@getById');
		Route::get ('getByCreatedId', 'API\RuleController@getByCreatedId');
		Route::post ('save', 'API\RuleController@save');
		Route::post ('updateById', 'API\RuleController@updateById');
		Route::post ('deleteById', 'API\RuleController@deleteById');
		Route::get ('getCount', 'API\RuleController@getCount');
	});

	Route::prefix ('siteindex')->group(function(){
		Route::get ('getAll', 'API\SiteindexController@getAll');
		Route::get ('getById', 'API\SiteindexController@getById');
		Route::get ('getByCreatedId', 'API\SiteindexController@getByCreatedId');
		Route::post ('save', 'API\SiteindexController@save');
		Route::post ('updateById', 'API\SiteindexController@updateById');
		Route::post ('deleteById', 'API\SiteindexController@deleteById');
	});

	Route::prefix ('siteview')->group(function(){
		Route::get ('getAll', 'API\SiteviewController@getAll');
		Route::get ('getById', 'API\SiteviewController@getById');
		Route::get ('getByCreatedId', 'API\SiteviewController@getByCreatedId');
		Route::post ('save', 'API\SiteviewController@save');
		Route::post ('updateById', 'API\SiteviewController@updateById');
		Route::post ('deleteById', 'API\SiteviewController@deleteById');
	});


Route::get ('news/newest', 'API\NewsController@newest');
Route::get ('publication/newest', 'API\PublicationController@newest');
Route::get ('event/newest', 'API\EventController@newest');
Route::get ('rule/getByType', 'API\RuleController@getByType');
Route::get ('rule/getAll', 'API\RuleController@getAll');
Route::get ('insert', 'API\ContentController@insert');

Route::get ('publication/getByPage', 'API\PublicationController@getByPage');
Route::get ('news/getByPage', 'API\NewsController@getByPage');
Route::get ('news/getById', 'API\NewsController@getById');
Route::get ('comments/getByType', 'API\CommentController@getByType');
Route::get ('sendmail', 'API\UserController@sendmail');

Route::post ('/comment/submit','webpage\CommentController@submit');
Route::post ('/comment/update/{type}/{status}/{id}', 'API\CommentController@update');

Route::post ('/saran/submit', 'webpage\SaranController@submit');