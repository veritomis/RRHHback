<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PuestoNomenclatura;

class PuestoNomenclaturaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/puesto-nomenclaturas', $puestoNomenclatura
        );

        $this->assertApiResponse($puestoNomenclatura);
    }

    /**
     * @test
     */
    public function test_read_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/puesto-nomenclaturas/'.$puestoNomenclatura->id
        );

        $this->assertApiResponse($puestoNomenclatura->toArray());
    }

    /**
     * @test
     */
    public function test_update_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->create();
        $editedPuestoNomenclatura = PuestoNomenclatura::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/puesto-nomenclaturas/'.$puestoNomenclatura->id,
            $editedPuestoNomenclatura
        );

        $this->assertApiResponse($editedPuestoNomenclatura);
    }

    /**
     * @test
     */
    public function test_delete_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/puesto-nomenclaturas/'.$puestoNomenclatura->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/puesto-nomenclaturas/'.$puestoNomenclatura->id
        );

        $this->response->assertStatus(404);
    }
}
