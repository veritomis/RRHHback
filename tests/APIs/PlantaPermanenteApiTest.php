<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PlantaPermanente;

class PlantaPermanenteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planta_permanente()
    {
        $plantaPermanente = PlantaPermanente::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/planta-permanentes', $plantaPermanente
        );

        $this->assertApiResponse($plantaPermanente);
    }

    /**
     * @test
     */
    public function test_read_planta_permanente()
    {
        $plantaPermanente = PlantaPermanente::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/planta-permanentes/'.$plantaPermanente->id
        );

        $this->assertApiResponse($plantaPermanente->toArray());
    }

    /**
     * @test
     */
    public function test_update_planta_permanente()
    {
        $plantaPermanente = PlantaPermanente::factory()->create();
        $editedPlantaPermanente = PlantaPermanente::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/planta-permanentes/'.$plantaPermanente->id,
            $editedPlantaPermanente
        );

        $this->assertApiResponse($editedPlantaPermanente);
    }

    /**
     * @test
     */
    public function test_delete_planta_permanente()
    {
        $plantaPermanente = PlantaPermanente::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/planta-permanentes/'.$plantaPermanente->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/planta-permanentes/'.$plantaPermanente->id
        );

        $this->response->assertStatus(404);
    }
}
