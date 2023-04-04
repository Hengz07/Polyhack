<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'user', 
            'role', 
            'org-structure',
            'module',
            'config',
            'survey'
        ];

        foreach ($groups as $group) {
            // $permission = new Permission();
            // $permission->name = $group;
            // $group_id = $permission->save();

            $group_id = Permission::create(['name' => $group]);

            Permission::create(['parent_id' => $group_id->id, 'name' => $group . '-view']);
            Permission::create(['parent_id' => $group_id->id, 'name' => $group . '-list']);
            Permission::create(['parent_id' => $group_id->id, 'name' => $group . '-create']);
            Permission::create(['parent_id' => $group_id->id, 'name' => $group . '-edit']);
            Permission::create(['parent_id' => $group_id->id, 'name' => $group . '-delete']);
            Permission::create(['parent_id' => $group_id->id, 'name' => $group . '-fetch']);

            if ($group == 'user') {
                Permission::create(['parent_id' => $group_id->id, 'name' => 'user-impersonate']);
                Permission::create(['parent_id' => $group_id->id, 'name' => 'user-dashboard']);
            }
        }

        ## System Group 
        $systemGroup = Permission::create(['name' => 'system']);
        Permission::create(['parent_id' => $systemGroup->id, 'name' => 'home']);
        Permission::create(['parent_id' => $systemGroup->id, 'name' => 'log-view']);
        Permission::create(['parent_id' => $systemGroup->id, 'name' => 'logged-as']);
        Permission::create(['parent_id' => $systemGroup->id, 'name' => 'system-config']);
        Permission::create(['parent_id' => $systemGroup->id, 'name' => 'search']);

        ## EWP Group 
        $ewpGroup = Permission::create(['name' => 'ewp']);
        Permission::create(['parent_id' => $ewpGroup->id, 'name' => 'admin-dashboard']);
        Permission::create(['parent_id' => $ewpGroup->id, 'name' => 'ewp-question']);
        Permission::create(['parent_id' => $ewpGroup->id, 'name' => 'ewp-scale']);
        Permission::create(['parent_id' => $ewpGroup->id, 'name' => 'ewp-schedule']);
        Permission::create(['parent_id' => $ewpGroup->id, 'name' => 'ewp-screening']);
        Permission::create(['parent_id' => $ewpGroup->id, 'name' => 'ewp-specific']);
    }
}
