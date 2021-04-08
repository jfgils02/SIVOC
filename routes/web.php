<?php

use Illuminate\Support\Facades\Route;

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
Route::delete('inicio/{id}/destroyFile', 'WelcomeController@destroyFile')->name('welcome.destroyFile');
Route::post('inicio/{id}/uploadFile', 'WelcomeController@uploadFile')->name('welcome.uploadFile');
Route::get('inicio/showButtonFile/{id}', 'WelcomeController@showButtonFile')->name('welcome.showButtonFile');
Route::get('inicio/button', 'WelcomeController@buttons')->name('welcome.button');
Route::post('inicio/save', 'WelcomeController@store')->name('welcome.store');
Route::resource('inicio', 'WelcomeController');

Auth::routes();

//autentificacion quitar los comentarios en produccion

/*Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');*/

Route::get('/home', 'HomeController@index')->name('home');

//USERS
Route::get('/users/restore/{id}', 'UserController@restore')->name('users.restore');
Route::resource('users', 'UserController');
Route::post('/register_user', 'UserController@store');
Route::delete('/users/detele/{id}', 'UserController@destroy')->name('users.destroy');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');


//PROJECTS
Route::post('projects/{id}/uploadFile', 'ProjectController@uploadFile')->name('projects.uploadFile');
Route::get('projects/{project}/showFile', 'ProjectController@showFile')->name('projects.showFile');
Route::post('projects/board/createBoard', 'ProjectController@createBoard')->name('projects.createBoard');
Route::get('projects/board/showBoards/{tablero}', 'ProjectController@showBoards');
Route::post('/register_project', 'ProjectController@store');
Route::get('projects/board/showBoards/{tablero}', 'ProjectController@showBoards');
Route::resource('projects', 'ProjectController');

//INDICADORES
Route::resource('indicators', 'IndicatorController');
//Route::get('/indicators', 'IndicatorController@index');
Route::post('/indicators/create', 'IndicatorController@store');
Route::post('/indicators/create/typeIndicator', 'IndicatorController@createIndicatorType');
Route::post('/indicators/create/minMax', 'IndicatorController@getMinMax');
Route::post('/indicators/grafica', 'IndicatorController@graph');

//DOCUMENTS POR AREA
/*Route::get('/masteer', function() {
    return view('master');
})->name('master');*/

Route::get('/folder/{area}', 'AreaDocumentController@index');#->name('almacen');
Route::get('/folder2/{area}/{filesLevelZero}', 'AreaDocumentController@filesLevelZero');#->name('almacen');
Route::get('/folder/{areaId}/{nivel}/{idPadre}', 'AreaDocumentController@getFoldersAndFiles');
Route::post('/folder/create/{areaId}/{nivel}', 'AreaDocumentController@createFolder');
Route::post('/folder/update/{folderId}', 'AreaDocumentController@updateFolder');
Route::post('/file/create/{areaId}/{nivel}', 'AreaDocumentController@createFiles');
Route::post('/file/delete', 'AreaDocumentController@deleteFile');
Route::get('/file/download/{documentId}/{idFolder}', 'AreaDocumentController@downloadFile');

//CLIENTES
Route::post('customers/store', 'CustomerController@store');
Route::delete('customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');
Route::resource('customers', 'CustomerController');

//NORMAS
Route::post('rules/store', 'RuleController@store');
Route::delete('rules/{rule}', 'RuleController@destroy')->name('rules.destroy');
Route::resource('rules', 'RuleController');

//MINUTAS
Route::post('minutes/{minute}/uploadFile', 'MinuteController@uploadFile')->name('minutes.uploadFile');
Route::post('minutes/agreement', 'MinuteController@storeAgreement')->name('minutes.storeAgreement');
Route::get('minutes/showAgreements/{id}', 'MinuteController@showAgreement')->name('minutes.showAgreement');
Route::get('minutes/showMinuteFiles/{id}', 'MinuteController@showMinuteFile')->name('minutes.showMinuteFile');
Route::resource('minutes', 'MinuteController');

//ACCIONES CORRECTIVAS
Route::post('correctiveActions/destroyfile/{id}', 'CorrectiveActionController@destroyfile')->name('correctiveActionController.destroyfile');
Route::post('correctiveActions/{id}/uploadFile', 'CorrectiveActionController@uploadFile')->name('correctiveActionController.uploadFile');
Route::get('correctiveActions/edit/{id}', 'CorrectiveActionController@edit')->name('correctiveActionController.edit');
Route::get('correctiveActions/showCorrectiveActionsFiles/{id}', 'CorrectiveActionController@showCorrectiveActionFile')->name('correctiveActionController.showCorrectiveActionFile');
Route::resource('correctiveActions', 'CorrectiveActionController');

//AUDITORIA INTERNA
Route::get('internalAudits/{internalAudits}/uploadFile', 'InternalAuditController@uploadFile')->name('internalAudits.uploadFile');
Route::get('internalAudits/{internalAudits}/showFiles', 'InternalAuditController@showFiles')->name('internalAudits.showFiles');;
Route::resource('internalAudits', 'InternalAuditController');

//DOCUMENTOS SGC
Route::post('sgc/{sgc}/uploadFile', 'SgcController@uploadFile')->name('sgc.uploadFile');
Route::get('sgc/{sgc}/files', 'SgcController@showFiles')->name('sgc.showFiles');
Route::delete('sgc/{sgc}/destroyFile', 'SgcController@destroyFile')->name('sgc.destroyFile');
Route::resource('sgc', 'SgcController');

//ACTIVOS
Route::get('assets/showAssetFiles/{asset}', 'AssetController@showAssetFiles')->name('assets.showAssetFiles');
Route::post('assets/{asset}/uploadFile', 'AssetController@uploadFile')->name('assets.uploadFile');
Route::get('assets/{asset}/showFiles', 'AssetController@showFiles')->name('assets.showFiles');
Route::resource('assets', 'AssetController');

//RH
Route::post('rh/{empleado}/uploadFile', 'RhController@uploadFile')->name('rh.uploadFile');
Route::get('rh/{empleado}/files', 'RhController@files')->name('rh.files');
Route::resource('rh', 'RhController');




/*Auth::routes();
 
Route::get('/home', 'HomeController@index')->name('home');
 
//Roles y Permisos
 
Route::middleware(['auth'])->group(function(){
 
	//Products
	Route::post('products/store', 'ProductController@store')->name('products.store')
		->middleware('permission:products.create');
 
	Route::get('products', 'ProductController@index')->name('products.index')
		->middleware('permission:products.index');
 
	Route::get('products/create', 'ProductController@create')->name('products.create')
		->middleware('permission:products.create');
 
	Route::put('products/{product}', 'ProductController@update')->name('products.update')
		->middleware('permission:products.edit');
 
	Route::get('products/{product}', 'ProductController@show')->name('products.show')
		->middleware('permission:products.show');
 
	Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy')
		->middleware('permission:products.destroy');
 
	Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit')
		->middleware('permission:products.edit'); */

