<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findByName('admin');
        $artistRole = Role::findByName('artist');

        // Assign 'admin' role to user with ID 1
        User::findOrFail(1)->assignRole($adminRole);

        User::findOrFail(2)->assignRole($artistRole);
    }
}
