<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Za3touri', 
            'email' => 'firasbaccouch5@gmail.com',
            'password' => bcrypt('123456789'),
            'roles_name' => ["owner"],
            ]);
            $admin->givePermissionTo('create','update','delete','softdelete','guest','owner','admin');
            $role = Role::create(['name' => 'owner','guard_name' => 'admin',]);
            
            $permissions = Permission::pluck('id','id')->all();
      
            $role->syncPermissions($permissions);
       
            $admin->assignRole([$role->id]);
            $admin2 = Admin::create([
                'name' => 'Fares', 
                'email' => 'fares@gmail.com',
                'password' => bcrypt('123456789'),
                'roles_name' => ["super_admin"],
                ]);
                $admin2->givePermissionTo('create','update','delete','guest','admin');
                $role2 = Role::create(['name' => 'super_admin','guard_name' => 'admin',]);
                
                $permissions2 = Permission::where([['name','!=','owner'],['name','!=','softdelete']])->pluck('id','id');
          
                $role2->syncPermissions($permissions2);
           
                $admin2->assignRole([$role2->id]);

    }
}
