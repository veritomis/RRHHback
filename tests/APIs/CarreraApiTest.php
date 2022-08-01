<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Carrera;

class CarreraApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_carrera()
    {
        $carrera = Carrera::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/carreras', $carrera
        );

        $this->assertApiResponse($carrera);
    }

    /**
     * @test
     */
    public function test_read_carrera()
    {
        $carrera = Carrera::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/carreras/'.$carrera->id
        );

        $this->assertApiResponse($carrera->toArray());
    }

    /**
     * @test
     */
    public function test_update_carrera()
    {
        $carrera = Carrera::factory()->create();
        $editedCarrera = Carrera::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/carreras/'.$carrera->id,
            $editedCarrera
        );

        $this->assertApiResponse($editedCarrera);
    }

    /**
     * @test
     */
    public function test_delete_carrera()
    {
        $carrera = Carrera::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/carreras/'.$carrera->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/carreras/'.$carrera->id
        );

        $this->response->assertStatus(404);
    }
}
