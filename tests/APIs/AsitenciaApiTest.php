<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Asitencia;

class AsitenciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_asitencia()
    {
        $asitencia = Asitencia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/asitencias', $asitencia
        );

        $this->assertApiResponse($asitencia);
    }

    /**
     * @test
     */
    public function test_read_asitencia()
    {
        $asitencia = Asitencia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/asitencias/'.$asitencia->id
        );

        $this->assertApiResponse($asitencia->toArray());
    }

    /**
     * @test
     */
    public function test_update_asitencia()
    {
        $asitencia = Asitencia::factory()->create();
        $editedAsitencia = Asitencia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/asitencias/'.$asitencia->id,
            $editedAsitencia
        );

        $this->assertApiResponse($editedAsitencia);
    }

    /**
     * @test
     */
    public function test_delete_asitencia()
    {
        $asitencia = Asitencia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/asitencias/'.$asitencia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/asitencias/'.$asitencia->id
        );

        $this->response->assertStatus(404);
    }
}
