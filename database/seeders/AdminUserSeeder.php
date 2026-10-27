<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * The first administrator account for the admin panel.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'Jitendraloon@gmail.com'],
            [
                'name' => 'Jitendra',
                'password' => 'Password',
                'role' => 'admin',
                'job_title' => 'Founder',
            ],
        );
    }
}
