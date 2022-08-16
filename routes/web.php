<?php


use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
 

    // Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('farmers')->group(function () {
        Route::get('/search', 'FarmerInputController@search')->name('search');
    });

    Route::prefix('sub_county')->group(function () {
        Route::get('/sub_counties_with_county_id', 'SubCountyController@sub_counties_with_county_id');
    });

    Route::prefix('farmer_input')->group(function () {
        Route::get('/get_sub_inputs', 'FarmerInputController@get_sub_inputs');
        Route::post('/store_farmer_input_item', 'FarmerInputController@store_farmer_input_item');
    });

    Route::prefix('produce')->group(function () {
        Route::get('/get_sub_produce', 'ProduceController@get_sub_produce');
    });

    Route::prefix('farmer_produce')->group(function () {
        Route::resource('/', 'FarmerProduceController');
    });



    Route::prefix('group_member')->group(function () {
        Route::get('/add_farmer_to_group', 'GroupMemberController@add_farmer_to_group');
        Route::get('/make_leader/{group_id}/{farmer_id}', 'GroupMemberController@make_leader');
        Route::get('/remove_group_leader/{group_member_id}/', 'GroupMemberController@remove_group_leader');
    });


    Route::prefix('report')->group(function () {
        Route::get('/farmers', 'ReportController@farmers');
        Route::get('/groups', 'ReportController@groups');
        Route::get('/group_members', 'ReportController@group_members');
        Route::get('/group_members_list', 'ReportController@group_members_list');
        Route::post('/search_farmers', 'ReportController@search_farmers');
        Route::post('/search_groups', 'ReportController@search_groups');
    });

    Route::resource('group_members', 'GroupMemberController');

    Route::get('/organization_documents/delete/{doc_id}', 'OrganizationDocumentsController@delete_document');


    Route::prefix('admin')->group(function () {
        Route::get('/roles/create', 'Admin\\UserController@role_create');
        Route::get('/roles/', 'Admin\\UserController@role_index');
        Route::get('/roles/{role_id}/edit', 'Admin\\UserController@role_edit');
        Route::post('/roles/destroy_role', 'Admin\\UserController@destroy_role');
        Route::post('/roles/role_store', 'Admin\\UserController@role_store');
        Route::post('/roles/update_role', 'Admin\\UserController@update_role');
        Route::resource('/users', 'Admin\\UserController');
    });


    Route::post('/store_extension_service', 'FarmerInputController@store_extension_service');
    Route::get('/farmerservicedelete/{service_id}', 'FarmerInputController@farmerservicedelete');
    Route::get('/farmerinputdelete/{input_id}', 'FarmerInputController@farmerinputdelete');


    Route::resource('farmer', 'FarmerController');
    Route::resource('farmer_input', 'FarmerInputController');
    Route::resource('farmer_produce', 'FarmerProduceController');
    Route::resource('group', 'GroupController');
    Route::resource('farmer_document', 'FarmerDocumentController');
    Route::resource('organization', 'OrganizationController');
    Route::resource('organization_document', 'OrganizationDocumentsController');
});
