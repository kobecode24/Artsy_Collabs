<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = [1, 2];
        $artistPermissions = [3, 4];

        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $artistRole = Role::where('name', 'artist')->firstOrFail();

        $adminRole->syncPermissions($adminPermissions);

        $artistRole->syncPermissions($artistPermissions);
    }
}
