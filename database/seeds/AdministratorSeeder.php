<?php

namespace Wantp\Neat\Database\Seeds;

use Illuminate\Database\Seeder;
use Wantp\Neat\Models\Role;
use Wantp\Neat\Models\User;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'nickname' => 'Admin super',
            'password' => bcrypt('admin123456'),
        ]);

        $role = Role::create([
            'name' => 'Administrator',
            'slug' => Role::ADMINISTRATOR_SLUG,
            'remarks' => 'Super administrator!',
        ]);

        $user->roles()->save($role);
    }
}
