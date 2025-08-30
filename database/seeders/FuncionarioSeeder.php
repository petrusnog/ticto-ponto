<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $funcionarioRole = Role::where('name', 'funcionario')->first();

        User::factory(33)->create([
            'password' => Hash::make('funcionariosenha'),
            'admin_id' => User::where('email', 'gpetersen@ticto.com')->first()->id,
            'role_id' => $funcionarioRole->id
        ]);

        User::factory(33)->create([
            'password' => Hash::make('funcionariosenha'),
            'admin_id' => User::where('email', 'tfinch@ticto.com')->first()->id,
            'role_id' => $funcionarioRole->id
        ]);
    }
}
