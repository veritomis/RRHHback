<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Contrato;

class ContratoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contrato()
    {
        $contrato = Contrato::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contratos', $contrato
        );

        $this->assertApiResponse($contrato);
    }

    /**
     * @test
     */
    public function test_read_contrato()
    {
        $contrato = Contrato::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contratos/'.$contrato->id
        );

        $this->assertApiResponse($contrato->toArray());
    }

    /**
     * @test
     */
    public function test_update_contrato()
    {
        $contrato = Contrato::factory()->create();
        $editedContrato = Contrato::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contratos/'.$contrato->id,
            $editedContrato
        );

        $this->assertApiResponse($editedContrato);
    }

    /**
     * @test
     */
    public function test_delete_contrato()
    {
        $contrato = Contrato::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contratos/'.$contrato->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contratos/'.$contrato->id
        );

        $this->response->assertStatus(404);
    }
}
