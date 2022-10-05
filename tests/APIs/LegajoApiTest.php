<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Legajo;

class LegajoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_legajo()
    {
        $legajo = Legajo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/legajos', $legajo
        );

        $this->assertApiResponse($legajo);
    }

    /**
     * @test
     */
    public function test_read_legajo()
    {
        $legajo = Legajo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/legajos/'.$legajo->id
        );

        $this->assertApiResponse($legajo->toArray());
    }

    /**
     * @test
     */
    public function test_update_legajo()
    {
        $legajo = Legajo::factory()->create();
        $editedLegajo = Legajo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/legajos/'.$legajo->id,
            $editedLegajo
        );

        $this->assertApiResponse($editedLegajo);
    }

    /**
     * @test
     */
    public function test_delete_legajo()
    {
        $legajo = Legajo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/legajos/'.$legajo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/legajos/'.$legajo->id
        );

        $this->response->assertStatus(404);
    }
}
