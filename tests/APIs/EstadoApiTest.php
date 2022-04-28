<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Estado;

class EstadoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_estado()
    {
        $estado = Estado::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/estados', $estado
        );

        $this->assertApiResponse($estado);
    }

    /**
     * @test
     */
    public function test_read_estado()
    {
        $estado = Estado::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/estados/'.$estado->id
        );

        $this->assertApiResponse($estado->toArray());
    }

    /**
     * @test
     */
    public function test_update_estado()
    {
        $estado = Estado::factory()->create();
        $editedEstado = Estado::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/estados/'.$estado->id,
            $editedEstado
        );

        $this->assertApiResponse($editedEstado);
    }

    /**
     * @test
     */
    public function test_delete_estado()
    {
        $estado = Estado::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/estados/'.$estado->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/estados/'.$estado->id
        );

        $this->response->assertStatus(404);
    }
}
