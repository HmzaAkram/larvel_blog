<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\UserStatus;  // Ensure the correct namespace
use App\UserType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('securePassword123'),
            'username' => 'admin',
            'type' => UserType::SuperAdmin->value, 
            'status' => UserStatus::Active->value, 
        ]);

        User::create([
            'name' => 'Hmza',
            'email' => 'hmza@gmail.com',
            'password' => Hash::make('securePassword123'),
            'username' => 'hmza',
            'type' => UserType::User->value, 
            'status' => UserStatus::Active->value,
        ]);
    }
}
