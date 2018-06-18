<?php

namespace App\Repositories;


use App\Permission;
use Optimus\Genie\Repository;

class PermissionRepository extends Repository
{
    protected function getModel()
    {
        return new Permission;
    }

    public function create(array $data)
    {
        $permission = Permission::create(['guard_name' => 'web', 'name' => $data['name']]);
        return $permission;
    }
}