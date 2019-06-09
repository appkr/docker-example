<?php

Route::get('/health', function () {
    return new \Illuminate\Http\JsonResponse([
        'status' => 'UP',
    ]);
});

Route::get('/', function () {
    return view('welcome');
});
