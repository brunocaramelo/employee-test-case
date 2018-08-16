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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1'], function () 
{
    Route::group(['prefix' => 'employees'], function () 
    {
        Route::get('/',
                        [ 'as' => 'employees-list', 
                        'uses' => '\Admin\Employee\Controllers\EmployeeController@listAll' 
                    ]);

    });

    Route::group(['prefix' => 'employee'], function () 
    {
        Route::post('/',
                            [ 'as' => 'create-employee', 
                            'uses' => '\Admin\Employee\Controllers\EmployeeController@create' 
                            ]);
        Route::get('/{id}',
                            [ 'as' => 'view-employee', 
                            'uses' => '\Admin\Employee\Controllers\EmployeeController@findById' 
                            ]);

        Route::put('/{id}',
                            [ 'as' => 'update-employee', 
                            'uses' => '\Admin\Employee\Controllers\EmployeeController@update' 
                            ]);

        Route::delete('/{id}',
                            [ 'as' => 'delete-employee', 
                            'uses' => '\Admin\Employee\Controllers\EmployeeController@remove' 
                            ]);

    });

});
    