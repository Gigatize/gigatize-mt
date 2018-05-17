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
Route::group(['middleware' => 'auth:api'], function () {

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('users','API\UserController');
    Route::get('/user', 'API\UserController@user');

    /*
    |--------------------------------------------------------------------------
    | Project Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('projects','API\ProjectController');
    Route::get('projects/{project}/relationships/owner', 'API\ProjectRelationshipController@Owner')->name('projects.relationships.owner');
    Route::get('projects/{project}/owner', 'API\ProjectRelationshipController@Owner')->name('projects.owner');
    Route::get('projects/{project}/relationships/category','API\ProjectRelationshipController@Category')->name('projects.relationships.category');
    Route::get('projects/{project}/category','API\ProjectRelationshipController@Category')->name('projects.category');
    Route::get('projects/{project}/relationships/skills','API\ProjectRelationshipController@Skills')->name('projects.relationships.skills');
    Route::get('projects/{project}/skills','API\ProjectRelationshipController@Skills')->name('projects.skills');
    Route::get('projects/{project}/relationships/users','API\ProjectRelationshipController@Users')->name('projects.relationships.users');
    Route::get('projects/{project}/users','API\ProjectRelationshipController@Users')->name('projects.users');
    Route::get('projects/{project}/relationships/location','API\ProjectRelationshipController@Location')->name('projects.relationships.location');
    Route::get('projects/{project}/location','API\ProjectRelationshipController@Location')->name('projects.location');
    Route::get('projects/{project}/relationships/acceptance-criteria','API\ProjectRelationshipController@AcceptanceCriteria')->name('projects.relationships.acceptance-criteria');
    Route::get('projects/{project}/acceptance-criteria','API\ProjectRelationshipController@AcceptanceCriteria')->name('projects.acceptance-criteria');
    Route::get('projects/{project}/relationships/sponsors','API\ProjectRelationshipController@Sponsors')->name('projects.relationships.sponsors');
    Route::get('projects/{project}/sponsors','API\ProjectRelationshipController@Sponsors')->name('projects.sponsors');
    Route::get('projects/{project}/relationships/comments','API\ProjectRelationshipController@Comments')->name('projects.relationships.comments');
    Route::get('projects/{project}/comments','API\ProjectRelationshipController@Comments')->name('projects.comments');
});

