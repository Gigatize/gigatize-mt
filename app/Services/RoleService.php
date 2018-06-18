<?php

namespace App\Services;

use App\Http\Requests\CreateRoleFormRequest;
use App\Permission;
use App\Repositories\RoleRepository;
use App\Role;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class RoleService {

    private $auth;

    private $dispatcher;

    private $roleRepository;

    public function __construct(Dispatcher $dispatcher, RoleRepository $roleRepository) {
        $this->dispatcher = $dispatcher;
        $this->roleRepository = $roleRepository;
    }

    public function getAll($options = [])
    {
        $user = Auth::user();
        if($user->can('manage users') or $user->can('manage everything')) {
            return $this->roleRepository->get($options);
        }else{
            return false;
        }
    }

    public function getById($id, $options){
        $user = Auth::user();
        if($user->can('manage users') or $user->can('manage everything')) {
            return $this->roleRepository->getById($id, $options);
        }else{
            return false;
        }
    }

    public function create(CreateRoleFormRequest $request){
        $user = Auth::user();
        if($user->can('manage everything')){
            $data = $request->all();
            $role = $this->roleRepository->create($data);

            return $role;
        }else{
            return false;
        }
    }
}