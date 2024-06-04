<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Consultas;
use App\Models\Notas;

class ConsultaNotaTest extends TestCase
{
    use RefreshDatabase;

    protected $psicologo; 
    protected $paciente; 
    protected $consulta;

    protected function setUp(): void
    {
        parent::setUp();

        $this->psicologo = User::factory()->create([
            'role' => '2' 
        ]);

        $this->paciente = User::factory()->create([
            'role' => '0'
        ]);

        $this->consulta = Consultas::create([
            'psicologo_id' => $this->psicologo->id,
            'paciente_id' => $this->paciente->id,
            'data' => now()->toDateString(),
            'hora' => now()->toTimeString()
        ]);

        $this->actingAs($this->psicologo);
    }


    public function test_psicologo_pode_ver_consultas()
    {
        $response = $this->get(route('psicologo.dashboard'));
        $response->assertStatus(200);
        $response->assertSee($this->consulta->data);
    }


    public function test_psicologo_pode_adicionar_nota()
    {
        $response = $this->post(route('note.add', $this->consulta->id), [
            'notas' => 'Nota importante sobre o paciente.'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('notas', [
            'consulta' => $this->consulta->id,
            'nota' => 'Nota importante sobre o paciente.'
        ]);
    }


    public function test_psicologo_pode_atualizar_nota()
    {
        $nota = Notas::create([
            'consulta' => $this->consulta->id,
            'psicologo' => $this->psicologo->id,
            'nota' => 'Nota inicial.'
        ]);

        $response = $this->put(route('note.update', $nota->id), [
            'nota' => 'Nota atualizada.'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('notas', [
            'id' => $nota->id,
            'nota' => 'Nota atualizada.'
        ]);
    }


    public function test_psicologo_pode_deletar_nota()
    {
        $nota = Notas::create([
            'consulta' => $this->consulta->id,
            'psicologo' => $this->psicologo->id,
            'nota' => 'Nota a ser deletada.'
        ]);

        $response = $this->delete(route('note.delete', $nota->id));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('notas', [
            'id' => $nota->id
        ]);
    }
}

