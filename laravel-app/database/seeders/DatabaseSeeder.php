<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //psicologo
            [
                'name' =>  'magas',
                'email' => 'magas@magas.com',
                'password' => Hash::make('password'),
                'cep'=>'13324340',
                'role' => '2',
            ],
        ]);
        
        DB::table('users')->insert([
            //secretario
            [
                'name' =>  'denis',
                'email' => 'denis@denis.com',
                'password' => Hash::make('password'),
                'cep'=>'13033195',
                'role' => '1',
            ],
        ]);

        DB::table('users')->insert([
            //secretario
            [
                'name' =>  'pedro',
                'email' => 'pedro@pedro.com',
                'password' => Hash::make('password'),
                'cep'=>'13033195',
                'role' => '1',
            ],
        ]);

        DB::table('users')->insert([
            //paciente
            [
                'name' =>  'berti',
                'email' => 'berti@berti.com',
                'password' => Hash::make('password'),
                'cep'=>'13087570',
                'role' => '0',
            ],
        ]);

        DB::table('users')->insert([
            //paciente
            [
                'name' =>  'Guto',
                'email' => 'guto@gigantesco.com',
                'password' => Hash::make('password'),
                'cep'=>'13272000',
                'role' => '3',
            ],
        ]);
    }
}
