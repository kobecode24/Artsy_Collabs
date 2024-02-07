<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Retrieve roles
        $adminRole = Role::where('name', 'admin')->first();
        $artistRole = Role::where('name', 'artist')->first();

        for ($i = 1; $i <= 5; $i++) {
            // Create a new user
            $user = User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'), // Use a hashed password
                'image' => null, // Assuming you don't have images to seed
                'description' => 'A description for user ' . $i, // Static description for example
            ]);

            // Assign roles to the user
            if ($i === 1) {
                // Assign the first user the 'admin' role
                $user->assignRole($adminRole);
            } else {
                // Assign the other users the 'artist' role
                $user->assignRole($artistRole);
            }
    }
}
}
