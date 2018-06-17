<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\CreateRoleFormRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RolesResource;
use App\Role;
use App\Services\RoleService;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class RoleController extends LaravelController
{
    use EloquentBuilderTrait;

    private $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return RolesResource
     */
    public function index(Request $request)
    {
        if(!Auth::user()->can('manage everything')) {
            $request->merge([
                'filter_groups' => [
                    [
                        'filters' => [
                            ["name", "eq", "super admin", true]
                        ]
                    ]
                ]
            ]);
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();
        $data = $this->roleService->getAll($resourceOptions);

        if($data) {
            $parsedData = $this->parseData($data, $resourceOptions, 'roles');
            // Create JSON response of parsed data
            return new RolesResource($parsedData['roles']);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  CreateRoleFormRequest  $request
     * @return RoleResource
     */
    public function store(CreateRoleFormRequest $request)
    {
        $role = $this->roleService->create($request);

        if($role) {
            return new RoleResource($role);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Role $role
     * @return RoleResource
     */
    public function show(Role $role)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->roleService->getById($role->id, $resourceOptions);

        if($data) {
            $parsedData = $this->parseData($data, $resourceOptions, 'role');
            // Create JSON response of parsed data
            return new RoleResource($parsedData['role']);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }
    }
}
