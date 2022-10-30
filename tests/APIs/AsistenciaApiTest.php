<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Asistencia;

class AsistenciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_asistencia()
    {
        $asistencia = Asistencia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/asistencias', $asistencia
        );

        $this->assertApiResponse($asistencia);
    }

    /**
     * @test
     */
    public function test_read_asistencia()
    {
        $asistencia = Asistencia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/asistencias/'.$asistencia->id
        );

        $this->assertApiResponse($asistencia->toArray());
    }

    /**
     * @test
     */
    public function test_update_asistencia()
    {
        $asistencia = Asistencia::factory()->create();
        $editedAsistencia = Asistencia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/asistencias/'.$asistencia->id,
            $editedAsistencia
        );

        $this->assertApiResponse($editedAsistencia);
    }

    /**
     * @test
     */
    public function test_delete_asistencia()
    {
        $asistencia = Asistencia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/asistencias/'.$asistencia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/asistencias/'.$asistencia->id
        );

        $this->response->assertStatus(404);
    }
}
