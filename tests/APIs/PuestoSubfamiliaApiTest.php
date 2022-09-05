<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PuestoSubfamilia;

class PuestoSubfamiliaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/puesto-subfamilias', $puestoSubfamilia
        );

        $this->assertApiResponse($puestoSubfamilia);
    }

    /**
     * @test
     */
    public function test_read_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/puesto-subfamilias/'.$puestoSubfamilia->id
        );

        $this->assertApiResponse($puestoSubfamilia->toArray());
    }

    /**
     * @test
     */
    public function test_update_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->create();
        $editedPuestoSubfamilia = PuestoSubfamilia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/puesto-subfamilias/'.$puestoSubfamilia->id,
            $editedPuestoSubfamilia
        );

        $this->assertApiResponse($editedPuestoSubfamilia);
    }

    /**
     * @test
     */
    public function test_delete_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/puesto-subfamilias/'.$puestoSubfamilia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/puesto-subfamilias/'.$puestoSubfamilia->id
        );

        $this->response->assertStatus(404);
    }
}
