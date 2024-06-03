<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class PacienteTest extends TestCase
{
    use RefreshDatabase;

    protected $paciente;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria e autentica um usuário fictício com a role 'paciente'
        $this->paciente = User::factory()->create([
            'role' => '2', // Role para 'paciente'
            'password' => bcrypt('password') // Senha criptografada
        ]);

        $this->actingAs($this->paciente);
    }


    public function testPacientePodeAcessarRotasDePaciente()
    {
        $paciente = User::factory()->create(['role' => '0']);

        $response = $this->actingAs($paciente)->get(route('paciente.dashboard'));
        $response->assertStatus(200);
    }


    public function test_paciente_pode_acessar_o_dashboard()
    {
        $response = $this->get(route('paciente.dashboard'));
        $response->assertStatus(200);
    }


    public function test_paciente_pode_visualizar_o_historico()
    {
        $response = $this->get(route('paciente.historico'));
        $response->assertStatus(200);
    }

    public function test_paciente_pode_editar_seu_perfil()
    {
        $response = $this->get(route('profile.edit'));
        $response->assertStatus(200);
    }

}
