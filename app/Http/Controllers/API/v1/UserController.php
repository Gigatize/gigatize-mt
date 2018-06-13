<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Services\UserService;
use App\Traits\EloquentBuilderTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class UserController extends LaravelController
{
    use EloquentBuilderTrait;

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return UsersResource
     */
    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'users');

        // Create JSON response of parsed data
        return new UsersResource($parsedData['users']);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getById($user->id, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        // Create JSON response of parsed data
        return new UserResource($parsedData['user']);
    }

    public function user(){
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getById(Auth::id(), $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return new UserResource($parsedData['user']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
