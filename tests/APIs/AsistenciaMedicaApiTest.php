<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AsistenciaMedica;

class AsistenciaMedicaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/asistencia_medicas', $asistenciaMedica
        );

        $this->assertApiResponse($asistenciaMedica);
    }

    /**
     * @test
     */
    public function test_read_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/asistencia_medicas/'.$asistenciaMedica->id
        );

        $this->assertApiResponse($asistenciaMedica->toArray());
    }

    /**
     * @test
     */
    public function test_update_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->create();
        $editedAsistenciaMedica = AsistenciaMedica::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/asistencia_medicas/'.$asistenciaMedica->id,
            $editedAsistenciaMedica
        );

        $this->assertApiResponse($editedAsistenciaMedica);
    }

    /**
     * @test
     */
    public function test_delete_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/asistencia_medicas/'.$asistenciaMedica->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/asistencia_medicas/'.$asistenciaMedica->id
        );

        $this->response->assertStatus(404);
    }
}
