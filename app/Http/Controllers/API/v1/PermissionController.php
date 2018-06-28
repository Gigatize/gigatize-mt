<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\CreatePermissionFormRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionsResource;
use App\Permission;
use App\Services\PermissionService;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class PermissionController extends LaravelController
{
    use EloquentBuilderTrait;

    private $permissionService;

    public function __construct(PermissionService $permissionService) {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return PermissionsResource
     */
    public function index(Request $request)
    {
        if(!Auth::user()->can('manage everything')) {
            $request->merge([
                'filter_groups' => [
                    [
                        'filters' => [
                            ["name", "eq", "manage_everything", true]
                        ]
                    ]
                ]
            ]);
        }
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->permissionService->getAll($resourceOptions);

        if($data) {
            $parsedData = $this->parseData($data, $resourceOptions, 'permissions');
            // Create JSON response of parsed data
            return new PermissionsResource($parsedData['permissions']);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  CreatePermissionFormRequest  $request
     * @return PermissionResource
     */
    public function store(CreatePermissionFormRequest $request)
    {
        $permission = $this->permissionService->create($request);

        if($permission) {
            return new PermissionResource($permission);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Permission $permission
     * @return PermissionResource
     */
    public function show(Permission $permission)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->permissionService->getById($permission->id, $resourceOptions);

        if($data) {
            $parsedData = $this->parseData($data, $resourceOptions, 'permission');
            // Create JSON response of parsed data
            return new PermissionResource($parsedData['permission']);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }
    }
}
