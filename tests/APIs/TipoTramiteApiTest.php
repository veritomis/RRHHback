<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TipoTramite;

class TipoTramiteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipo_tramites', $tipoTramite
        );

        $this->assertApiResponse($tipoTramite);
    }

    /**
     * @test
     */
    public function test_read_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tipo_tramites/'.$tipoTramite->id
        );

        $this->assertApiResponse($tipoTramite->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->create();
        $editedTipoTramite = TipoTramite::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipo_tramites/'.$tipoTramite->id,
            $editedTipoTramite
        );

        $this->assertApiResponse($editedTipoTramite);
    }

    /**
     * @test
     */
    public function test_delete_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipo_tramites/'.$tipoTramite->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipo_tramites/'.$tipoTramite->id
        );

        $this->response->assertStatus(404);
    }
}
