<?php

namespace App\Repositories;


use App\Role;
use Optimus\Genie\Repository;

class RoleRepository extends Repository
{
    protected function getModel()
    {
        return new Role;
    }

    public function create(array $data)
    {
        $role = Role::create(['guard_name' => 'web', 'name' => $data['name']]);
        return $role;
    }
}