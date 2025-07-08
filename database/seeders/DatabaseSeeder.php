<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //Default Roles
        $roles = [
            'super_admin',
            'admin',
            'user',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        //Super Admin Account
        User::factory()->create([
            'name' => 'Jomar Soliman',
            'email' => 'jomarsoliman01@gmail.com',
            'role_id' => Role::where('name', 'super_admin')->first()->id,
        ]);

        //Admin Account
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        //User Account
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);

        //User Account
        User::factory()->create([
            'name' => 'Kamote',
            'email' => 'kamote@example.com',
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);

        //This is custom Seeder
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
        ]);

    }
}
