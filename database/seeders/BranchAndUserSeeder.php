<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BranchAndUserSeeder extends Seeder
{
    public function run(): void
    {
        $branch = Branch::create([
            'name' => 'Main Branch',
            'phone' => '012 345 678',
            'address' => 'Phnom Penh, Cambodia',
        ]);

        User::create([
            'branch_id' => $branch->id,
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
