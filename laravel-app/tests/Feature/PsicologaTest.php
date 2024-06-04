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
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret123'),
            'role' => '2', 
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    public function test_psico_dashboard_render(): void
    {
        $user = User::factory()->create(['role' => '2']);

        $this->actingAs($user);

        $response = $this->get('/dashboard-ps');

        $response->assertOk();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');

        $this->assertGuest();
    }
}