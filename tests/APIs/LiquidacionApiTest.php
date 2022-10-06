<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Liquidacion;

class LiquidacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/liquidacions', $liquidacion
        );

        $this->assertApiResponse($liquidacion);
    }

    /**
     * @test
     */
    public function test_read_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/liquidacions/'.$liquidacion->id
        );

        $this->assertApiResponse($liquidacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->create();
        $editedLiquidacion = Liquidacion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/liquidacions/'.$liquidacion->id,
            $editedLiquidacion
        );

        $this->assertApiResponse($editedLiquidacion);
    }

    /**
     * @test
     */
    public function test_delete_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/liquidacions/'.$liquidacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/liquidacions/'.$liquidacion->id
        );

        $this->response->assertStatus(404);
    }
}
