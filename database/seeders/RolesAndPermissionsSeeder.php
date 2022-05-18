<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create',
            'update',
            'delete',
            'softdelete',
            'guest',
            'owner',
            'admin',

            
        ];

        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission,'guard_name' => 'admin']);
            }
    }
}
