<?php

namespace Database\Seeders;

use App\Models\EmployeePosition;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->delete();
        EmployeePosition::query()->delete();

        $units = Unit::pluck('id');
        $positions = Position::pluck('id');

        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => 'User ' . $i,
                'username' => 'user' . $i,
                'password' => Hash::make('password123'),
                'unit_id' => $units->random(),
                'join_date' => now()->subDays(rand(1, 365)),
                'is_active' => rand(0, 1),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $positionsToAdd = $positions->random(rand(1, 3));
            foreach ($positionsToAdd as $positionId) {
                EmployeePosition::create([
                    'user_id' => $user->id,
                    'position_id' => $positionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
