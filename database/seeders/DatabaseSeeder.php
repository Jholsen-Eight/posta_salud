<?php

namespace Database\Seeders;

use App\Models\PersonalMedico;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $medicoUser = User::factory()->create([
            'name' => 'Dra. Rosa Huamán',
            'email' => 'medico@posta.test',
            'rol' => 'personal_medico',
        ]);

        PersonalMedico::factory()->create([
            'nombres' => 'Rosa',
            'apellidos' => 'Huamán',
            'especialidad' => 'Medicina general',
            'activo' => true,
            'user_id' => $medicoUser->id,
        ]);

        PersonalMedico::factory(4)->create(['activo' => true]);
        PersonalMedico::factory()->create(['activo' => false]);
    }
}