<?php

namespace App\Services;

use App\Http\Requests\CreatePermissionFormRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class PermissionService {

    private $auth;

    private $dispatcher;

    private $permissionRepository;

    public function __construct(Dispatcher $dispatcher, PermissionRepository $permissionRepository) {
        $this->dispatcher = $dispatcher;
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll($options = [])
    {
        $user = Auth::user();
        if($user->can('manage users')) {
            return $this->permissionRepository->get($options);
        }else{
            return false;
        }
    }

    public function getById($id, $options){
        $user = Auth::user();
        if($user->can('manage users')) {
            return $this->permissionRepository->getById($id, $options);
        }else{
            return false;
        }
    }

    public function create(CreatePermissionFormRequest $request){
        $user = Auth::user();
        if($user->can('manage everything')){
            $data = $request->all();
            $permission = $this->permissionRepository->create($data);

            return $permission;
        }else{
            return false;
        }
    }
}