<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Funcion;

class FuncionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_funcion()
    {
        $funcion = Funcion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/funcions', $funcion
        );

        $this->assertApiResponse($funcion);
    }

    /**
     * @test
     */
    public function test_read_funcion()
    {
        $funcion = Funcion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/funcions/'.$funcion->id
        );

        $this->assertApiResponse($funcion->toArray());
    }

    /**
     * @test
     */
    public function test_update_funcion()
    {
        $funcion = Funcion::factory()->create();
        $editedFuncion = Funcion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/funcions/'.$funcion->id,
            $editedFuncion
        );

        $this->assertApiResponse($editedFuncion);
    }

    /**
     * @test
     */
    public function test_delete_funcion()
    {
        $funcion = Funcion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/funcions/'.$funcion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/funcions/'.$funcion->id
        );

        $this->response->assertStatus(404);
    }
}
