<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/countries', 'Api\InitnController@countries');
Route::get('/counties', 'Api\InitnController@counties');
Route::get('/sub_counties/{county}', 'Api\InitnController@sub_counties');
Route::get('/gender', 'Api\InitnController@gender');



Route::prefix('farmer')->group(function () {

    Route::get('/get_farmers/{user_id}', 'Api\FarmerController@get_farmers');
    Route::get('/get_farmer_by_id/{farmer_id}', 'Api\FarmerController@get_farmer_by_id');
    Route::get('/search_farmers/{user_id}/{seach_term}', 'Api\FarmerController@search_farmers');
    Route::post('/create', 'Api\FarmerController@create');
    Route::post('/update', 'Api\FarmerController@update');
});

Route::prefix('farmer_produce')->group(function () {
    Route::get('/init_data', 'Api\FarmerProduceController@init_data');
    Route::get('/sub_produce/{produce_id}', 'Api\FarmerProduceController@sub_produce');
    Route::post('/add', 'Api\FarmerProduceController@add');
    Route::post('/delete', 'Api\FarmerProduceController@delete');
});

Route::prefix('farm_input')->group(function () {
    Route::get('/get_farm_inputs', 'Api\FarmerInputController@get_farm_inputs');
    Route::get('/search_farmer/{search_term}/{user_id}', 'Api\FarmerInputController@search_farmer');
    Route::get('/get_init_details', 'Api\FarmerInputController@get_init_details');
    Route::get('/add_farm_input_init', 'Api\FarmerInputController@add_farm_input_init');
    Route::get('/get_sub_input_data', 'Api\FarmerInputController@get_sub_input_data');
    Route::post('/add', 'Api\FarmerInputController@add');
    Route::post('/add_farm_input_item', 'Api\FarmerInputController@add_farm_input_item');
    Route::post('/delete_farm_input_item', 'Api\FarmerInputController@delete_farm_input_item');
    Route::post('/delete_farm_input', 'Api\FarmerInputController@delete_farm_input');
});


Route::prefix('organization')->group(function () {
    Route::get('/get_organizations', 'Api\OrganizationController@get_organizations');
});


Route::prefix('group')->group(function () {
    Route::get('/init_data', 'Api\GroupController@init_data');
    Route::get('/group_details/{group_id}/{user_id}', 'Api\GroupController@group_details');
    Route::get('/init_edit_data/{group_id}', 'Api\GroupController@init_edit_data');
    Route::get('/get_groups/{user_id}', 'Api\GroupController@get_groups');
    Route::get('/search_groups/{user_id}/{seach_term}', 'Api\GroupController@search_groups');
    Route::get('/add_farmer_to_group/{member_id}', 'Api\GroupController@add_farmer_to_group');
    Route::get('/remove_member_from_group/{member_id}/{user_id}/{group_id}', 'Api\GroupController@remove_member_from_group');
    Route::post('/add', 'Api\GroupController@add');
    Route::post('/update', 'Api\GroupController@update');
    Route::post('/add_farmer_to_group', 'Api\GroupController@add_farmer_to_group');
    Route::post('/make_leader', 'Api\GroupController@make_leader');
    Route::post('/remove_leader', 'Api\GroupController@remove_leader');
});


Route::get('/dashboard_stats', 'Api\FarmerController@dashboard_stats');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::post('/user/update_profile', 'UserController@update_profile');



//Route::middleware('auth:api')->get('/user', function (Request $request) {
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});
