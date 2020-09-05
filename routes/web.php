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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/event', function (){
    $data = [
        'topic_id' => 'onNewData',
        'data' => 'someData: ' . rand(1,100),
    ];
    \App\Classes\Socket\Pusher::sentDataToServer($data);
    var_dump($data);
});
