<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::factory()->create([
            'name' => 'Guilherme Petersen',
            'email' => 'gpetersen@ticto.com',
            'cargo' => 'Chief AI Officer',
            'password' => Hash::make('tictosenha'),
            'role_id' => $adminRole->id
        ]);

        User::factory()->create([
            'name' => 'Thiago Finch',
            'email' => 'tfinch@ticto.com',
            'cargo' => 'CEO',
            'password' => Hash::make('tictosenha'),
            'role_id' => $adminRole->id
        ]);
    }
}
