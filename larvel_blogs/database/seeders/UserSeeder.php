<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'type' => 'superadmin', // Use string values if enums are not defined
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Hmza',
            'email' => 'hmza@gmail.com',
            'password' => Hash::make('securePassword123'),
            'username' => 'hmza', // Unique username
            'type' => 'user',
            'status' => 'active',
        ]);
    }
}
