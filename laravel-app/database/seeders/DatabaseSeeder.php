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
            //psicologos
            [
                'name' =>  'Magaldi',
                'email' => 'magaldi@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'13324340',
                'role' => '2',
            ],
            [
                'name' =>  'Andrezza',
                'email' => 'dezza@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'13073003',
                'role' => '2',
            ],
            [
                'name' =>  'Alexandre',
                'email' => 'xand@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'58070250',
                'role' => '2',
            ],
            [
                'name' =>  'Felipe',
                'email' => 'konda@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'13199358',
                'role' => '2',
            ]   
        ]);
        
        DB::table('users')->insert([
            //secretarios
            [
                'name' =>  'Daniel',
                'email' => 'denis@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'13033195',
                'role' => '1',
            ],
            [
                'name' =>  'Pedro',
                'email' => 'pedro@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'13033170',
                'role' => '1',
            ],
            [
                'name' =>  'Matheus',
                'email' => 'tue@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'01001000',
                'role' => '1',
            ],
            [
                'name' =>  'Hugo',
                'email' => 'ugu@psicoclin.com',
                'password' => Hash::make('password'),
                'cep'=>'13087901',
                'role' => '1',
            ],
        ]);


        DB::table('users')->insert([
            //pacientes
            [
                'name' =>  'Berti',
                'email' => 'berti@gmail.com',
                'password' => Hash::make('password'),
                'cep'=>'13087570',
                'role' => '0',
            ],
            [
                'name' =>  'Sofia',
                'email' => 'sofia@gmail.com',
                'password' => Hash::make('password'),
                'cep'=>'13087570',
                'role' => '0',
            ],
            [
                'name' =>  'Danilo',
                'email' => 'danilao@gmail.com',
                'password' => Hash::make('password'),
                'cep'=>'15520000',
                'role' => '0',
            ],
            [
                'name' =>  'Vinicius Galassi',
                'email' => 'galassi@gmail.com',
                'password' => Hash::make('password'),
                'cep'=>'13033580',
                'role' => '0',
            ],
            [
                'name' =>  'Vinicius Hardy',
                'email' => 'hardy@gmail.com',
                'password' => Hash::make('password'),
                'cep'=>'13033580',
                'role' => '0',
            ],
        ]);

        DB::table('users')->insert([
            //admin
            [
                'name' =>  'Augusto',
                'email' => 'guto@admin.com',
                'password' => Hash::make('password'),
                'cep'=>'13272000',
                'role' => '3',
            ],
        ]);

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $tomorrow = Carbon::tomorrow();

        DB::table('consultas')->insert([
            //consultas com magas
            [
                'paciente_id' =>  '9',//berti
                'psicologo_id' => '1',
                'data'=>$yesterday->format('Y-m-d'),
                'hora' => '12:30:00',
            ],
            [
                'paciente_id' =>  '10',//sofia
                'psicologo_id' => '1',
                'data'=>$today->format('Y-m-d'),
                'hora' => '8:00:00',
            ],
            [
                'paciente_id' =>  '9',
                'psicologo_id' => '1',
                'data'=>$today->format('Y-m-d'),
                'hora' => '15:30:00',
            ],
        ]);
        DB::table('consultas')->insert([
            //consultas com alexandre
            [
                'paciente_id' =>  '12',//galassi
                'psicologo_id' => '3',
                'data'=>$tomorrow->format('Y-m-d'),
                'hora' => '12:30:00',
            ],
            [
                'paciente_id' =>  '11',//danilo
                'psicologo_id' => '3',
                'data'=>$today->format('Y-m-d'),
                'hora' => '8:00:00',
            ],
            [
                'paciente_id' =>  '12',
                'psicologo_id' => '3',
                'data'=>$today->format('Y-m-d'),
                'hora' => '15:30:00',
            ],
        ]);
        DB::table('consultas')->insert([
            //consultas com magas
            [
                'paciente_id' =>  '9',//berti
                'psicologo_id' => '2',
                'data'=>$yesterday->format('Y-m-d'),
                'hora' => '12:30:00',
            ],
            [
                'paciente_id' =>  '10',//sofia
                'psicologo_id' => '2',
                'data'=>$today->format('Y-m-d'),
                'hora' => '8:00:00',
            ],
            [
                'paciente_id' =>  '9',//berti
                'psicologo_id' => '1',
                'data'=>$tomorrow->format('Y-m-d'),
                'hora' => '15:30:00',
            ],
        ]);
    }
}
