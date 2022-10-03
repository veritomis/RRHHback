<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Capacitacion;

class CapacitacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/capacitacions', $capacitacion
        );

        $this->assertApiResponse($capacitacion);
    }

    /**
     * @test
     */
    public function test_read_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/capacitacions/'.$capacitacion->id
        );

        $this->assertApiResponse($capacitacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->create();
        $editedCapacitacion = Capacitacion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/capacitacions/'.$capacitacion->id,
            $editedCapacitacion
        );

        $this->assertApiResponse($editedCapacitacion);
    }

    /**
     * @test
     */
    public function test_delete_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/capacitacions/'.$capacitacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/capacitacions/'.$capacitacion->id
        );

        $this->response->assertStatus(404);
    }
}
