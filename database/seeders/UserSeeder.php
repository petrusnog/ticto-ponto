<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();

        User::factory()->create([
            'name' => 'Guilherme Petersen',
            'email' => 'gpetersen@ticto.com',
            'password' => Hash::make('tictosenha'),
            'role_id' => $adminRole->id
        ]);
    }
}
