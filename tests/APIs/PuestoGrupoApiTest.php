<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PuestoGrupo;

class PuestoGrupoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_puesto_grupo()
    {
        $puestoGrupo = PuestoGrupo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/puesto-grupos', $puestoGrupo
        );

        $this->assertApiResponse($puestoGrupo);
    }

    /**
     * @test
     */
    public function test_read_puesto_grupo()
    {
        $puestoGrupo = PuestoGrupo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/puesto-grupos/'.$puestoGrupo->id
        );

        $this->assertApiResponse($puestoGrupo->toArray());
    }

    /**
     * @test
     */
    public function test_update_puesto_grupo()
    {
        $puestoGrupo = PuestoGrupo::factory()->create();
        $editedPuestoGrupo = PuestoGrupo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/puesto-grupos/'.$puestoGrupo->id,
            $editedPuestoGrupo
        );

        $this->assertApiResponse($editedPuestoGrupo);
    }

    /**
     * @test
     */
    public function test_delete_puesto_grupo()
    {
        $puestoGrupo = PuestoGrupo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/puesto-grupos/'.$puestoGrupo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/puesto-grupos/'.$puestoGrupo->id
        );

        $this->response->assertStatus(404);
    }
}
