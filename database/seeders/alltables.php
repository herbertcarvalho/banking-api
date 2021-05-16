<?php

namespace Database\Seeders;

#models
use App\Models\contas_abertas;
use App\Models\info_usuario;
use App\Models\transferencias;
use App\Models\User;

#imports
use Illuminate\Database\Seeder;

class alltables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'herbert_chagas@hotmail.com',
            'password' => '123',
            'name' => 'Herbert'
        ]);

        User::create([
            'email' => 'falcao@hotmail.com',
            'password' => '123',
            'name' => 'falcao'
        ]);

    }
}
