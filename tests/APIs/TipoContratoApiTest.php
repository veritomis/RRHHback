<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TipoContrato;

class TipoContratoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipo_contratos', $tipoContrato
        );

        $this->assertApiResponse($tipoContrato);
    }

    /**
     * @test
     */
    public function test_read_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tipo_contratos/'.$tipoContrato->id
        );

        $this->assertApiResponse($tipoContrato->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->create();
        $editedTipoContrato = TipoContrato::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipo_contratos/'.$tipoContrato->id,
            $editedTipoContrato
        );

        $this->assertApiResponse($editedTipoContrato);
    }

    /**
     * @test
     */
    public function test_delete_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipo_contratos/'.$tipoContrato->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipo_contratos/'.$tipoContrato->id
        );

        $this->response->assertStatus(404);
    }
}
