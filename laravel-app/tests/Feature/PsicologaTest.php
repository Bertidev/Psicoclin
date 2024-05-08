<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class PsicologaTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_acess_psico_page(): void
    {
        $response = $this->get('/psico');

        $response->assertRedirect('login');
    }

    public function testnewpsicoregistration(): void
    {
        // Criar um novo usuário
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        $user->password = 'secret123';
        $user->role = 'psicologo'; // Definir o papel do usuário

        // Salvar o usuário
        $result = $user->save();

        // Verificar se o usuário foi salvo com sucesso
        $this->assertTrue($result);
        $this->assertNotNull($user->id);
    }
}
