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

/*-----------------------Home--------------------*/

Route::get('/',function(){
    return redirect()->route('home.get.index');
});

Route::get('/demo/ajaxRequest', 'DemoController@ajaxRequest');
Route::post('/demo/ajaxRequest1', 'DemoController@ajaxRequestPost1');
Route::post('/demo/ajaxRequest2', 'DemoController@ajaxRequestPost2');

// Route::get('ajaxRequest', 'DemoController@ajaxRequest');
// Route::post('ajaxRequest', 'DemoController@ajaxRequestPost');



Route::group(['prefix' => 'home'] , function(){

    Route::get('/','HomeController@getIndex')->name('home.get.index');

    Route::get('/about','HomeController@getAbout')->name('home.get.about');

    Route::get('/{tit}','HomeController@getContent')->name('home.get.content');

    Route::get('/category/{cate}','HomeController@getCategory')->name('home.get.category');

    

    Route::group(['prefix' => 'user'] , function(){

        Route::get('/regis','HomeController@getRegis')->name('home.get.regis');
        Route::post('/regis','HomeController@postRegis')->name('home.post.regis');

        Route::get('/login','HomeController@getLogin')->name('home.get.login');
        Route::post('/login','HomeController@postLogin')->name('home.post.login');

        Route::get('/edit','HomeController@getEdit')->name('home.get.edit');
        Route::post('/edit','HomeController@postEdit')->name('home.post.edit');

        Route::get('/logout','HomeController@getLogout')->name('home.get.logout');

        Route::post('/comment/{new_id}','HomeController@postComment')->name('home.post.comment');

        Route::post('/changepass','HomeController@postChangePass')->name('home.post.changepass');

    });

});

/*-----------------------admin--------------------*/

Route::group(['prefix' => 'admin'] , function(){

    //-----Login admin
    Route::get('/login','AdminController@getLogin')->name('admin.get.login');
    Route::post('/login','AdminController@postLogin')->name('admin.post.login');

    //-----Middleware Admin
    Route::group(['middleware' => 'admin'],function(){

        Route::get('/','AdminController@getIndex')->name('admin.get.index');
        Route::post('/','AdminController@postIndex')->name('admin.post.index');

        //-----New
        Route::group(['prefix' => 'news'],function(){

            Route::get('/list','NewController@getList')->name('admin.new.get.list');
            Route::post('/list','NewController@postList')->name('admin.new.post.list');

            Route::get('/create','NewController@getCreate')->name('admin.new.get.create');
            Route::post('/create','NewController@postCreate')->name('admin.new.post.create');

            Route::get('/edit/{id}','NewController@getEdit')->name('admin.new.get.edit');
            Route::post('/edit/{id}','NewController@postEdit')->name('admin.new.post.edit');

            Route::get('/delete/{id}','NewController@getDelete')->name('admin.new.get.delete');

        });

        //-----User
        Route::group(['prefix' => 'users'],function(){

            Route::get('/list','UserController@getList')->name('admin.user.get.list');
            Route::post('/list','UserController@postList')->name('admin.user.post.list');

            Route::get('/create','UserController@getCreate')->name('admin.user.get.create');
            Route::post('/create','UserController@postCreate')->name('admin.user.post.create');

            Route::get('/edit/{id}','UserController@getEdit')->name('admin.user.get.edit');
            Route::post('/edit/{id}','UserController@postEdit')->name('admin.user.post.edit');

            Route::get('/delete/{id}','UserController@getDelete')->name('admin.user.get.delete');

        });

        //-----category
        Route::group(['prefix' => 'categories'],function(){

            Route::get('/list','CateController@getList')->name('admin.category.get.list');
            Route::post('/list','CateController@postList')->name('admin.category.post.list');

            //-----Middleware Admin level2
            Route::group(['middleware' => 'admin2'],function(){

                Route::get('/create','CateController@getCreate')->name('admin.category.get.create');
                Route::post('/create','CateController@postCreate')->name('admin.category.post.create');

                Route::get('/edit/{id}','CateController@getEdit')->name('admin.category.get.edit');
                Route::post('/edit/{id}','CateController@postEdit')->name('admin.category.post.edit');

                Route::get('/delete/{id}','CateController@getDelete')->name('admin.category.get.delete');

            });

        });

        //-----Comment
        Route::group(['prefix' => 'comment'],function(){

            Route::get('/list','CmtController@getList')->name('admin.cmt.get.list');
            
            Route::get('/delete/{id}','CmtController@getDelete')->name('admin.cmt.get.delete');

            Route::get('/edit/{id}','CmtController@getEdit')->name('admin.cmt.get.edit');
            Route::post('/edit/{id}','CmtController@postEdit')->name('admin.cmt.post.edit');
          
        });

        //-----Middleware Manages admin info
        Route::group(['prefix' => 'info'],function(){

            Route::get('/logout','AdminController@getLogout')->name('admin.info.get.logout');

            Route::post('/changepass','AdminController@postChangePass')->name('admin.info.post.changepass');

            Route::get('/yourprofile','AdminController@getProfile')->name('admin.info.get.profile');

            Route::get('/edit','AdminController@getEdit')->name('admin.info.get.edit');
            Route::post('/edit','AdminController@postEdit')->name('admin.info.post.edit');

            Route::get('/listadmin','AdminController@getListAdmin')->name('admin.info.get.listadmin');

            Route::get('/ad-info/{id}','AdminController@getAdminInfo')->name('admin.info.get.admininfo');

            //-----Middleware Admin level 3
            Route::group(['middleware' => 'admin3'],function(){

                Route::get('/edit-ad-info/{id}','AdminController@getEditAdminInfo')->name('admin.info.get.editadmininfo');
                Route::post('/edit-ad-info/{id}','AdminController@postEditAdminInfo')->name('admin.info.post.editadmininfo');

                Route::get('/create','AdminController@getCreate')->name('admin.info.get.create');
                Route::post('/create','AdminController@postCreate')->name('admin.info.post.create');

            });
            
        });
        
        
    });

});