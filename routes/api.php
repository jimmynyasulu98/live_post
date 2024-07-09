<?php

use App\Helpers\Routes\RouteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# load routes specific  to a resource
 Route::prefix('v1')
    ->group(function(){
        RouteHelper::routeFiles( __DIR__ . '/api/v1');
    });

/**
* Route::prefix('v1')
*  ->group(function(){
*      
*       require __DIR__ . '/api/v1/user.php';
*  }); 
*/



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');