<?php

Route::get("users", "UserController@listUsers");
Route::post("users", "UserController@createUser");
//Route::post("users", "UserController@createUserAsync");
Route::put("users/{userId}", "UserController@updateUser");

