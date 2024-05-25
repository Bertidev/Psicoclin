<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


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
            //admin
            [
                'name' =>  'Guto',
                'email' => 'guto@gigantesco.com',
                'password' => Hash::make('password'),
                'cep'=>'13272000',
                'role' => '3',
            ],
        ]);

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $tomorrow = Carbon::tomorrow();

        DB::table('consultas')->insert([
            [
                'paciente_id' =>  '4',
                'psicologo_id' => '1',
                'data'=>$yesterday->format('Y-m-d'),
                'hora' => '12:30:00',
            ],
            [
                'paciente_id' =>  '4',
                'psicologo_id' => '1',
                'data'=>$today->format('Y-m-d'),
                'hora' => '8:00:00',
            ],
            [
                'paciente_id' =>  '4',
                'psicologo_id' => '1',
                'data'=>$today->format('Y-m-d'),
                'hora' => '15:30:00',
            ],
            [
                'paciente_id' =>  '4',
                'psicologo_id' => '1',
                'data'=>$tomorrow->format('Y-m-d'),
                'hora' => '9:30:00',
            ],
            [
                'paciente_id' =>  '4',
                'psicologo_id' => '1',
                'data'=>$tomorrow->format('Y-m-d'),
                'hora' => '17:45:00',
            ],
        ]);
    }
}
