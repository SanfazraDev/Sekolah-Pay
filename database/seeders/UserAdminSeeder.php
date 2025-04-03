<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $roles = Role::create([
           'name' => 'admin'
        ]);

        $admin = User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

    }
}
