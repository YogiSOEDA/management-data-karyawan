<?php

namespace Database\Seeders;

use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoginLog::truncate();

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(1, 10000); $i++) {
                LoginLog::create([
                    'user_id' => $user->id,
                    'login_time' => now()->subMinutes(rand(1, 1440)),
                    'logout_time' => now()->subMinutes(rand(1, 60)),
                    'status' => 'success', 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
