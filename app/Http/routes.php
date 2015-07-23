<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//tenant routes

Route::group(['domain' => '{account}.aria.app'], function () {

    Route::get('/','Tenant\TenantShopsController@index');

    Route::get('hello',function(){



        $repository = App::make('App\Domain\Models\Project\ProjectRepository');

        $projects = $repository->all();

        dd($projects);

    });

});

Route::group(['prefix' => 'api'], function()
{
    Route::post('members/register', 'App\Api\MembersController@postRegister');
    Route::post('members/login', 'App\Api\MembersController@postLogin');
    Route::post('products/upload', 'App\Api\Auth\ProductsController@postUpload');

    Route::group(['middleware' => 'api.auth'], function () {
        Route::resource('jobs', 'App\Api\JobsController');
        //user profile
        Route::get('members/info', 'App\Api\MembersController@getInfo');
        //products
        Route::resource('products', 'App\Api\Auth\ProductsController');
        Route::post('products/datatables', 'App\Api\Auth\ProductsController@getDataTables');
        //tags
        Route::resource('tags', 'App\Api\Auth\TagsController');


    });
});

Route::get('/','HomeController@index');


