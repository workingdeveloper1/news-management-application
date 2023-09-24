<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-news', 'guard_name' => 'api']);
        Permission::create(['name' => 'update-news', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete-news', 'guard_name' => 'api']);
        Permission::create(['name' => 'comment-news', 'guard_name' => 'api']);

        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'api']);
        $basicRole = Role::create(['name' => 'Basic','guard_name' => 'api']);

        $adminRole->givePermissionTo([
            'create-news',
            'update-news',
            'delete-news',
        ]);

        $basicRole->givePermissionTo([
            'comment-news'
        ]);

        $user = new User();
        $user->name = "Kadek Rizky Fransisca";
        $user->email = "kadekriz@gmail.com";
        $user->password = bcrypt("HelloWorld");
        $user->assignRole('Admin');
        $user->save();


    }
}
