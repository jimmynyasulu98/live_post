<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')
    ->group(function(){
        
     # load routes specific  to a resource

$dir = new RecursiveDirectoryIterator( __DIR__ . '/api/v1');
/**
 * @var RecursiveDirectoryIterator | RecursiveIteratorIterator  $iterator
 */
 $iterator = new RecursiveIteratorIterator($dir);
 while($iterator->valid()){
    if(!$iterator->isDot()
    && $iterator->isFile()
    && $iterator->isReadable()
    && $iterator->current()->getExtension() === 'php')
    {
         require $iterator->key();
    }
    $iterator->next();
 }


    });


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');