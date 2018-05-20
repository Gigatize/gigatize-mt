<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class TenantDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->addRolesAndPermissions();
    }
    private function addRolesAndPermissions()
    {
        // create permissions for an admin
        $gigSponsorPermissions = collect(['create project', 'edit project', 'delete project', 'join project'])->map(function ($name) {
            return Permission::create(['name' => $name]);
        });
        // add admin role
        $gigSponsorRole = Role::create(['name' => 'gig sponsor']);
        $gigParticipantRole = Role::create(['name' => 'gig participant']);
        $gigSponsorRole->givePermissionTo($gigSponsorPermissions);
        $gigParticipantRole->givePermissionTo(['join project']);
        // add a default user role
        Role::create(['name' => 'user']);
    }
}