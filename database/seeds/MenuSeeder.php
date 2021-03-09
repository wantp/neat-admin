<?php

namespace Wantp\Neat\Database\Seeds;

use Illuminate\Database\Seeder;
use Wantp\Neat\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'id' => 1,
                'parent_id' => 0,
                'name' => 'home',
                'path' => '/home',
                'icon' => 'HomeOutlined'
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'name' => 'neat',
                'path' => '/neat',
                'icon' => 'WindowsOutlined',
            ],
            [
                'id' => 3,
                'parent_id' => 2,
                'name' => 'users',
                'path' => '/neat/users',
                'icon' => '',
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'name' => 'roles',
                'path' => '/neat/roles',
                'icon' => '',
            ],
            [
                'id' => 6,
                'parent_id' => 2,
                'name' => 'permissions',
                'path' => '/neat/permissions',
                'icon' => '',
            ],
            [
                'id' => 7,
                'parent_id' => 2,
                'name' => 'menus',
                'path' => '/neat/menus',
                'icon' => '',
            ],
        ]);
    }
}
