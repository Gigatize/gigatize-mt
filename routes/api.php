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

    Route::group(['prefix' => '/v1'], function () {
        /*
        |--------------------------------------------------------------------------
        | User Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('users', 'API\v1\UserController');
        Route::get('user', 'API\v1\UserController@user');

        /*
        |--------------------------------------------------------------------------
        | Project Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('projects', 'API\v1\projectController');
        /*
        |--------------------------------------------------------------------------
        | Project Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('projects/{project}/relationships/owner', 'API\v1\ProjectRelationshipController@Owner')->name('projects.relationships.owner');
        Route::get('projects/{project}/owner', 'API\v1\ProjectRelationshipController@Owner')->name('projects.owner');
        Route::get('projects/{project}/relationships/category', 'API\v1\ProjectRelationshipController@Category')->name('projects.relationships.category');
        Route::get('projects/{project}/category', 'API\v1\ProjectRelationshipController@Category')->name('projects.category');
        Route::get('projects/{project}/relationships/skills', 'API\v1\ProjectRelationshipController@Skills')->name('projects.relationships.skills');
        Route::get('projects/{project}/skills', 'API\v1\ProjectRelationshipController@Skills')->name('projects.skills');
        Route::get('projects/{project}/relationships/users', 'API\v1\ProjectRelationshipController@Users')->name('projects.relationships.users');
        Route::get('projects/{project}/users', 'API\v1\ProjectRelationshipController@Users')->name('projects.users');
        Route::get('projects/{project}/relationships/location', 'API\v1\ProjectRelationshipController@Location')->name('projects.relationships.location');
        Route::get('projects/{project}/location', 'API\v1\ProjectRelationshipController@Location')->name('projects.location');
        Route::get('projects/{project}/relationships/acceptance-criteria', 'API\v1\ProjectRelationshipController@AcceptanceCriteria')->name('projects.relationships.acceptance-criteria');
        Route::get('projects/{project}/acceptance-criteria', 'API\v1\ProjectRelationshipController@AcceptanceCriteria')->name('projects.acceptance-criteria');
        Route::get('projects/{project}/relationships/sponsors', 'API\v1\ProjectRelationshipController@Sponsors')->name('projects.relationships.sponsors');
        Route::get('projects/{project}/sponsors', 'API\v1\ProjectRelationshipController@Sponsors')->name('projects.sponsors');
        Route::get('projects/{project}/relationships/comments', 'API\v1\ProjectRelationshipController@Comments')->name('projects.relationships.comments');
        Route::get('projects/{project}/comments', 'API\v1\ProjectRelationshipController@Comments')->name('projects.comments');

        Route::apiResource('users','API\v1\UserController');
        Route::apiResource('categories','API\v1\CategoryController');
        Route::apiResource('skills','API\v1\SkillController');
        Route::apiResource('locations','API\v1\LocationController');
        Route::apiResource('acceptance-criteria','API\v1\AcceptanceCriteriaController');
        Route::apiResource('comments','API\v1\CommentsController');
    });
});

