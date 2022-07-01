<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Agente;

class AgenteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_agente()
    {
        $agente = Agente::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/agentes', $agente
        );

        $this->assertApiResponse($agente);
    }

    /**
     * @test
     */
    public function test_read_agente()
    {
        $agente = Agente::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/agentes/'.$agente->id
        );

        $this->assertApiResponse($agente->toArray());
    }

    /**
     * @test
     */
    public function test_update_agente()
    {
        $agente = Agente::factory()->create();
        $editedAgente = Agente::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/agentes/'.$agente->id,
            $editedAgente
        );

        $this->assertApiResponse($editedAgente);
    }

    /**
     * @test
     */
    public function test_delete_agente()
    {
        $agente = Agente::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/agentes/'.$agente->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/agentes/'.$agente->id
        );

        $this->response->assertStatus(404);
    }
}
