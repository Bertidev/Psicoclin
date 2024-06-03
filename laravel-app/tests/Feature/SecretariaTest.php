<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class SecretariaTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria e autentica um usuário fictício com a role 'secretaria'
        $user = User::factory()->create([
            'role' => '1' // Role para 'secretaria'
        ]);

        $this->actingAs($user);
    }

   
    public function test_render_da_dashboard_da_secretaria()
    {
        $response = $this->get(route('secretaria.dashboard'));
        $response->assertStatus(200);
        // Adicione outras asserções conforme necessário
    }

    
    public function test_render_de_criacao_de_secretaria()
    {
        $response = $this->get(route('secretaria.create'));
        $response->assertStatus(200);
        // Adicione outras asserções conforme necessário
    }

    
    public function test_render_de_editar_perfil()
    {
        $user = User::factory()->create(['role' => '1']);
        $response = $this->get(route('secretaria.edit', $user->id));
        $response->assertStatus(200);
        // Adicione outras asserções conforme necessário
    }

    

    
    public function test_deleta_uma_secretaria()
    {
        $user = User::factory()->create(['role' => '1']);
        $response = $this->delete(route('secretaria.delete', $user->id));
        $response->assertStatus(302); // Redireciona após a exclusão
        $this->assertDatabaseMissing('users', [
            'email' => $user->email
        ]);
    }

    
    public function acesso_permitido_para_secretaria()
    {
        $response = $this->get(route('secretaria.dashboard'));
        $response->assertStatus(200);
    }

    
    public function acesso_negado_para_usuario_sem_permissao()
    {
        $otherUser = User::factory()->create(['role' => '0']);
        $this->actingAs($otherUser);
        $response = $this->get(route('secretaria.dashboard'));
        $response->assertStatus(403); // Forbidden
    }
}
