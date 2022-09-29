<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Evaluacion;

class EvaluacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/evaluaciones', $evaluacion
        );

        $this->assertApiResponse($evaluacion);
    }

    /**
     * @test
     */
    public function test_read_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/evaluaciones/'.$evaluacion->id
        );

        $this->assertApiResponse($evaluacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->create();
        $editedEvaluacion = Evaluacion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/evaluaciones/'.$evaluacion->id,
            $editedEvaluacion
        );

        $this->assertApiResponse($editedEvaluacion);
    }

    /**
     * @test
     */
    public function test_delete_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/evaluaciones/'.$evaluacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/evaluaciones/'.$evaluacion->id
        );

        $this->response->assertStatus(404);
    }
}
