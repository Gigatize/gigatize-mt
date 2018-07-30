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

    Route::group(['prefix' => '/v1'], function () {/*
        |--------------------------------------------------------------------------
        | Acceptance Criteria Routes
        |--------------------------------------------------------------------------
        */

        Route::apiResource('acceptance-criteria','API\v1\AcceptanceCriteriaController')->only([
            'index','show'
        ]);
        /*
        |--------------------------------------------------------------------------
        | Achievement Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('achievements','API\v1\AchievementController')->only([
            'index','show'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Achievement Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('achievements/{achievement}/relationships/user', 'API\v1\AchievementRelationshipController@User')->name('achievements.relationships.user');
        Route::get('achievements/{achievement}/user', 'API\v1\AchievementRelationshipController@User')->name('achievements.user');

        /*
        |--------------------------------------------------------------------------
        | Category Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('categories','API\v1\CategoryController')->only([
            'index','show','store'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Category Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('categories/{category}/relationships/projects', 'API\v1\CategoryRelationshipController@Projects')->name('categories.relationships.projects');
        Route::get('categories/{category}/projects', 'API\v1\CategoryRelationshipController@Projects')->name('categories.projects');

        /*
        |--------------------------------------------------------------------------
        | Comment Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('comments','API\v1\CommentController')->except([
            'store'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Comment Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('comments/{comment}/relationships/project', 'API\v1\CommentRelationshipController@Project')->name('comments.relationships.project');
        Route::get('comments/{comment}/project', 'API\v1\CommentRelationshipController@Project')->name('comments.project');

        Route::get('comments/{comment}/relationships/user', 'API\v1\CommentRelationshipController@User')->name('comments.relationships.user');
        Route::get('comments/{comment}/user', 'API\v1\CommentRelationshipController@User')->name('comments.user');

        /*
        |--------------------------------------------------------------------------
        | Notification Routes
        |---------------------------------------------------------------------a-----
        */
        Route::apiResource('notifications', 'API\v1\NotificationController')->only([
            'show','update'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Permissions Routes
        |---------------------------------------------------------------------a-----
        */
        Route::apiResource('permissions','API\v1\PermissionController')->only([
            'index','show'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Project Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('projects', 'API\v1\ProjectController');

        /*
        |--------------------------------------------------------------------------
        | Project Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('projects/{project}/relationships/acceptance-criteria', 'API\v1\ProjectRelationshipController@AcceptanceCriteria')->name('projects.relationships.acceptance-criteria');
        Route::get('projects/{project}/acceptance-criteria', 'API\v1\ProjectRelationshipController@AcceptanceCriteria')->name('projects.acceptance-criteria');
        Route::patch('projects/{project}/acceptance-criteria/{acceptance_criteria}', 'API\v1\ProjectRelationshipController@CompleteAcceptanceCriteria')->name('projects.complete-acceptance-criteria');

        Route::get('projects/{project}/relationships/category', 'API\v1\ProjectRelationshipController@Category')->name('projects.relationships.category');
        Route::get('projects/{project}/category', 'API\v1\ProjectRelationshipController@Category')->name('projects.category');

        Route::get('projects/{project}/relationships/comments', 'API\v1\ProjectRelationshipController@Comments')->name('projects.relationships.comments');
        Route::get('projects/{project}/comments', 'API\v1\ProjectRelationshipController@Comments')->name('projects.comments');
        Route::post('projects/{project}/comments', 'API\v1\ProjectRelationshipController@leaveComment')->name('comments.create');
        Route::patch('projects/{project}/comments/{comment}', 'API\v1\ProjectRelationshipController@editComment')->name('comments.edit');
        Route::delete('projects/{project}/comments/{comment}', 'API\v1\ProjectRelationshipController@deleteComment')->name('comments.delete');

        Route::get('projects/{project}/relationships/followers', 'API\v1\ProjectRelationshipController@Followers')->name('projects.relationships.followers');
        Route::get('projects/{project}/followers', 'API\v1\ProjectRelationshipController@Followers')->name('projects.followers');
        Route::post('projects/{project}/followers', 'API\v1\ProjectRelationshipController@createfollower')->name('projects.follow');
        Route::delete('projects/{project}/followers', 'API\v1\ProjectRelationshipController@deletefollower')->name('projects.unfollow');

        Route::get('projects/{project}/relationships/owner', 'API\v1\ProjectRelationshipController@Owner')->name('projects.relationships.owner');
        Route::get('projects/{project}/owner', 'API\v1\ProjectRelationshipController@Owner')->name('projects.owner');

        Route::get('projects/{project}/relationships/skills', 'API\v1\ProjectRelationshipController@Skills')->name('projects.relationships.skills');
        Route::get('projects/{project}/skills', 'API\v1\ProjectRelationshipController@Skills')->name('projects.skills');

        Route::get('projects/{project}/relationships/sponsors', 'API\v1\ProjectRelationshipController@Sponsors')->name('projects.relationships.sponsors');
        Route::get('projects/{project}/sponsors', 'API\v1\ProjectRelationshipController@Sponsors')->name('projects.sponsors');

        Route::get('projects/{project}/relationships/users', 'API\v1\ProjectRelationshipController@Users')->name('projects.relationships.users');
        Route::get('projects/{project}/users', 'API\v1\ProjectRelationshipController@Users')->name('projects.users');
        Route::post('projects/{project}/users', 'API\v1\ProjectRelationshipController@joinProject')->name('projects.join');
        Route::delete('projects/{project}/users', 'API\v1\ProjectRelationshipController@leaveProject')->name('projects.leave');

        Route::get('projects/{project}/relationships/votes', 'API\v1\ProjectRelationshipController@Votes')->name('projects.relationships.votes');
        Route::get('projects/{project}/votes', 'API\v1\ProjectRelationshipController@Votes')->name('projects.votes');
        Route::post('projects/{project}/votes', 'API\v1\ProjectRelationshipController@upVote')->name('projects.upvote');
        Route::delete('projects/{project}/votes', 'API\v1\ProjectRelationshipController@downVote')->name('projects.downvote');

        /*
        |--------------------------------------------------------------------------
        | Role Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('roles','API\v1\RoleController')->only([
            'index','show','store'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Role Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('roles/{role}/relationships/permissions', 'API\v1\RoleRelationshipController@Permissions')->name('roles.relationships.permissions');
        Route::get('roles/{role}/permissions', 'API\v1\RoleRelationshipController@Permissions')->name('roles.permissions');

        /*
        |--------------------------------------------------------------------------
        | Engagement Score Routes
        |--------------------------------------------------------------------------
        */
        Route::get('scores','API\v1\ScoreController@index')->name('scores.index');
        /*
        |--------------------------------------------------------------------------
        | Skill Routes
        |--------------------------------------------------------------------------
        */
        Route::apiResource('skills','API\v1\SkillController');

        /*
        |--------------------------------------------------------------------------
        | Skill Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('skills/{skill}/relationships/projects', 'API\v1\SkillRelationshipController@Projects')->name('skills.relationships.projects');
        Route::get('skills/{skill}/projects', 'API\v1\SkillRelationshipController@Projects')->name('skills.projects');

        Route::get('skills/{skill}/relationships/users', 'API\v1\SkillRelationshipController@Users')->name('skills.relationships.users');
        Route::get('skills/{skill}/users', 'API\v1\SkillRelationshipController@Users')->name('skills.users');

        /*
       |--------------------------------------------------------------------------
       | User Routes
       |--------------------------------------------------------------------------
       */
        Route::apiResource('users','API\v1\UserController')->except([
            'store'
        ]);
        Route::get('user', 'API\v1\UserController@user');
        Route::get('user/achievements', 'API\v1\UserRelationshipController@Achievements')->name('user.achievements');
        Route::get('user/comments', 'API\v1\UserRelationshipController@Comments')->name('user.comments');
        Route::get('user/followings', 'API\v1\UserRelationshipController@Followings')->name('user.followings');
        Route::get('user/owned-projects', 'API\v1\UserRelationshipController@OwnedProjects')->name('user.owned-projects');
        Route::get('user/notifications', 'API\v1\UserRelationshipController@Notifications')->name('user.notifications');
        Route::get('user/permissions', 'API\v1\UserRelationshipController@Permissions')->name('user.permissions');
        Route::get('user/projects', 'API\v1\UserRelationshipController@Projects')->name('user.projects');
        Route::get('user/roles', 'API\v1\UserRelationshipController@Roles')->name('user.roles');
        Route::get('user/score', 'API\v1\UserRelationshipController@engagementScore')->name('user.score');
        Route::get('user/skills', 'API\v1\UserRelationshipController@Skills')->name('user.skills');
        Route::get('user/votes', 'API\v1\UserRelationshipController@Votes')->name('user.votes');

        /*
        |--------------------------------------------------------------------------
        | User Relationship Routes
        |--------------------------------------------------------------------------
        */
        Route::get('users/{user}/relationships/achievements', 'API\v1\UserRelationshipController@Achievements')->name('users.relationships.achievements');
        Route::get('users/{user}/achievements', 'API\v1\UserRelationshipController@Achievements')->name('users.achievements');

        Route::get('users/{user}/relationships/comments', 'API\v1\UserRelationshipController@Comments')->name('users.relationships.comments');
        Route::get('users/{user}/comments', 'API\v1\UserRelationshipController@Comments')->name('users.comments');

        Route::get('users/{user}/relationships/followings', 'API\v1\UserRelationshipController@Followings')->name('users.relationships.followings');
        Route::get('users/{user}/followings', 'API\v1\UserRelationshipController@Followings')->name('users.followings');

        Route::get('users/{user}/relationships/owned-projects', 'API\v1\UserRelationshipController@OwnedProjects')->name('users.relationships.owned-projects');
        Route::get('users/{user}/owned-projects', 'API\v1\UserRelationshipController@OwnedProjects')->name('users.owned-projects');

        Route::get('users/{user}/relationships/permissions', 'API\v1\UserRelationshipController@Permissions')->name('users.relationships.permissions');
        Route::get('users/{user}/permissions', 'API\v1\UserRelationshipController@Permissions')->name('users.permissions');

        Route::get('users/{user}/relationships/projects', 'API\v1\UserRelationshipController@Projects')->name('users.relationships.projects');
        Route::get('users/{user}/projects', 'API\v1\UserRelationshipController@Projects')->name('users.projects');

        Route::get('users/{user}/relationships/roles', 'API\v1\UserRelationshipController@Roles')->name('users.relationships.roles');
        Route::get('users/{user}/roles', 'API\v1\UserRelationshipController@Roles')->name('users.roles');

        Route::get('users/{user}/score', 'API\v1\UserRelationshipController@engagementScore')->name('users.score');

        Route::get('users/{user}/relationships/skills', 'API\v1\UserRelationshipController@Skills')->name('users.relationships.skills');
        Route::get('users/{user}/skills', 'API\v1\UserRelationshipController@Skills')->name('users.skills');

        Route::get('users/{user}/relationships/votes', 'API\v1\UserRelationshipController@Votes')->name('users.relationships.votes');
        Route::get('users/{user}/votes', 'API\v1\UserRelationshipController@Votes')->name('users.votes');

    });
});

