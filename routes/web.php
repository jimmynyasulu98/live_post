<?php

use App\Models\User;
use App\Mail\WelcomEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


if (App::environment('local')){
    Route::get('/sent-mail', function () {
        $user = User::factory()->make();
        Mail::to($user)->send(new WelcomEmail($user));
        return null;
    });
}
