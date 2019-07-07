<?php

use Illuminate\Http\Request;

Route::get("users", "UserController@listUsers");
Route::post("users", "UserController@createUser");
Route::put("users/{userId}", "UserController@updateUser");

