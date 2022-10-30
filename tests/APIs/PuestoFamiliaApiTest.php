<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PuestoFamilia;

class PuestoFamiliaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/puesto-familias', $puestoFamilia
        );

        $this->assertApiResponse($puestoFamilia);
    }

    /**
     * @test
     */
    public function test_read_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/puesto-familias/'.$puestoFamilia->id
        );

        $this->assertApiResponse($puestoFamilia->toArray());
    }

    /**
     * @test
     */
    public function test_update_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->create();
        $editedPuestoFamilia = PuestoFamilia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/puesto-familias/'.$puestoFamilia->id,
            $editedPuestoFamilia
        );

        $this->assertApiResponse($editedPuestoFamilia);
    }

    /**
     * @test
     */
    public function test_delete_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/puesto-familias/'.$puestoFamilia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/puesto-familias/'.$puestoFamilia->id
        );

        $this->response->assertStatus(404);
    }
}
