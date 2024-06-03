<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class PsicologaTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_psico_registration(): void
    {
        // Criar um novo usuário usando a factory
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret123'), // A senha deve ser criptografada
            'role' => '2', // Definir o papel do usuário como psicólogo
        ]);

        // Verificar se o usuário foi salvo com sucesso
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    public function test_psico_dashboard_render(): void
    {
        // Criar e autenticar um usuário psicólogo
        $user = User::factory()->create(['role' => '2']);

        // Autenticar o usuário
        $this->actingAs($user);

        // Acessar a página do painel de controle do psicólogo
        $response = $this->get('/dashboard-ps');

        $response->assertOk();
    }

    public function test_authenticated_user_can_logout(): void
    {
        // Criar e autenticar um usuário
        $user = User::factory()->create();

        // Autenticar o usuário
        $this->actingAs($user);

        // Realizar logout
        $response = $this->post('/logout');

        $response->assertRedirect('/');

        // Verificar se o usuário foi desautenticado
        $this->assertGuest();
    }
}