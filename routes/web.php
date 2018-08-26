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



Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'LandingController@index');
    Route::get('/advantage', 'LandingController@advantage');
    Route::get('/video', 'LandingController@video');
    Route::get('/product', 'LandingController@product');

    Route::post('image/upload', 'ImageController@uploadImage');
    Route::post('doc/upload', 'ImageController@uploadDoc');
    Route::get('media/{file_name}', 'ImageController@getImage')->where('file_name', '.*');
    Route::get('file/{file_name}', 'ImageController@showFile')->where('file_name', '.*');

  /*  Route::resource('/', 'IndexController');*/
    Auth::routes();

    Route::group(['middleware' => ['auth']], function () {
        //Адреса для пользователи

        Route::group(['middleware' => ['company']], function () {
            Route::get('sop/template', 'SopController@index');
            Route::post('sop/selected', 'SopController@downloadSelected');
            Route::get('download/example/{filename}', 'SopController@downloadExample');
            Route::get('sop/download/all/{type}', 'SopController@downloadAll');
            Route::group(['prefix' => 'cabinet', 'namespace' => 'Cabinet',], function() {
                Route::get('/', 'IndexController@index');
                Route::get('pharmacy', 'PharmacyController@showPharmacyList');
                Route::get('pharmacy/add', 'PharmacyController@showPharmacyAdd');
                Route::get('pharmacy/{id}', 'PharmacyController@showPharmacyAdd');
                Route::post('pharmacy', 'PharmacyController@savePharmacy');
                Route::delete('pharmacy/{id}', 'PharmacyController@destroy');
                Route::get('requirement', 'RequirementController@showRequirement');
                Route::get('requirement/{id}', 'RequirementController@showRequirement');
                Route::get('ajax/requirement', 'RequirementController@getRequirementList');
                Route::get('ajax/document-by-requirement', 'RequirementController@getDocumentList');
                Route::get('ajax/document-pharmacy', 'RequirementController@setDocumentPharmacy');
                Route::get('ajax/document-pharmacy-delete', 'RequirementController@setDocumentPharmacyDelete');
            });
            
        });

        //Адреса для админа
        Route::group(['middleware' => ['admin']], function () {

            Route::prefix('admin')->group(function(){
                Route::get('/', 'Admin\IndexController@index');
                Route::resource('sop', 'SopController');

                //Для запросов Ajax
                Route::prefix('ajax')->group(function(){
                    Route::post('save/sop', 'Admin\AjaxAdminController@setSop');
                    Route::post('save/thumbs/{id}', 'Admin\AjaxAdminController@setSopThumbs');
                    Route::post('delete/thumbs/{id}/{sopId}', 'Admin\AjaxAdminController@removeThumb');
                    Route::post('main/thumb/{id}/{sopId}', 'Admin\AjaxAdminController@removeThumb');
                    Route::post('remove/sop/{sopId}', 'Admin\AjaxAdminController@removeSop');
                });

                Route::post('requirement/is_show', 'Admin\RequirementController@changeIsShow');
				 Route::post('requirement/sort', 'Admin\RequirementController@reorder');
                Route::resource('requirement', 'Admin\RequirementController');

                Route::get('document/image', 'Admin\DocumentController@getImageList');
                Route::get('document/file', 'Admin\DocumentController@getFileList');
                Route::get('document/website', 'Admin\DocumentController@getWebsiteList');
                Route::post('document/is_show', 'Admin\DocumentController@changeIsShow');
                Route::resource('document', 'Admin\DocumentController');

                Route::post('pharmacy/is_show', 'Admin\PharmacyController@changeIsShow');
                Route::resource('pharmacy', 'Admin\PharmacyController');

                Route::get('users/limit/{id}', 'Admin\UsersController@showUserLimitEdit');
                Route::post('users/limit', 'Admin\UsersController@editUserLimit');
                Route::post('users/is_show', 'Admin\UsersController@changeIsShow');
                Route::resource('users', 'Admin\UsersController');

            });
        });

        Route::prefix('ajax')->group(function(){
            Route::post('get-sop/{id}', 'Admin\AjaxAdminController@getSop');
            Route::get('get/thumbs/{id}/{size}', 'AjaxController@getSopThumbs');
        });

        Route::get('download/thumb/{filename}', 'SopController@downloadThumb');
    });

    Route::get('confirmation/{email}/{token}', 'Auth\RegisterController@confirmation');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



});



