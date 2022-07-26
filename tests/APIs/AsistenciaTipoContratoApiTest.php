<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AsistenciaTipoContrato;

class AsistenciaTipoContratoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/asistencia_tipo_contratos', $asistenciaTipoContrato
        );

        $this->assertApiResponse($asistenciaTipoContrato);
    }

    /**
     * @test
     */
    public function test_read_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/asistencia_tipo_contratos/'.$asistenciaTipoContrato->id
        );

        $this->assertApiResponse($asistenciaTipoContrato->toArray());
    }

    /**
     * @test
     */
    public function test_update_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->create();
        $editedAsistenciaTipoContrato = AsistenciaTipoContrato::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/asistencia_tipo_contratos/'.$asistenciaTipoContrato->id,
            $editedAsistenciaTipoContrato
        );

        $this->assertApiResponse($editedAsistenciaTipoContrato);
    }

    /**
     * @test
     */
    public function test_delete_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/asistencia_tipo_contratos/'.$asistenciaTipoContrato->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/asistencia_tipo_contratos/'.$asistenciaTipoContrato->id
        );

        $this->response->assertStatus(404);
    }
}
