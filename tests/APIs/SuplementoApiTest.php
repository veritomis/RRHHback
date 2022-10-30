<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Suplemento;

class SuplementoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_suplemento()
    {
        $suplemento = Suplemento::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/suplementos', $suplemento
        );

        $this->assertApiResponse($suplemento);
    }

    /**
     * @test
     */
    public function test_read_suplemento()
    {
        $suplemento = Suplemento::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/suplementos/'.$suplemento->id
        );

        $this->assertApiResponse($suplemento->toArray());
    }

    /**
     * @test
     */
    public function test_update_suplemento()
    {
        $suplemento = Suplemento::factory()->create();
        $editedSuplemento = Suplemento::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/suplementos/'.$suplemento->id,
            $editedSuplemento
        );

        $this->assertApiResponse($editedSuplemento);
    }

    /**
     * @test
     */
    public function test_delete_suplemento()
    {
        $suplemento = Suplemento::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/suplementos/'.$suplemento->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/suplementos/'.$suplemento->id
        );

        $this->response->assertStatus(404);
    }
}
