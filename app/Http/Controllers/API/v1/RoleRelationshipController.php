<?php
namespace App\Http\Controllers\API\v1;
use App\Http\Resources\PermissionsResource;
use App\Role;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Support\Facades\Auth;
use Optimus\Bruno\LaravelController;

class RoleRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function Permissions(Role $role)
    {
        $user = Auth::user();
        if($user->can('manage users')) {
            // Parse the resource options given by GET parameters
            $resourceOptions = $this->parseResourceOptions();

            $parsedData = $this->parseData($role->permissions, $resourceOptions, 'permissions');

            return new PermissionsResource($parsedData['permissions']);
        }else{
            return response()->json(['message'=>'Unauthorized action','error'=>403],403);
        }
    }

    public function AssignPermission(Role $role){

    }

}