<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\VinculacionLaboral;

class VinculacionLaboralApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/vinculacion_laborals', $vinculacionLaboral
        );

        $this->assertApiResponse($vinculacionLaboral);
    }

    /**
     * @test
     */
    public function test_read_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/vinculacion_laborals/'.$vinculacionLaboral->id
        );

        $this->assertApiResponse($vinculacionLaboral->toArray());
    }

    /**
     * @test
     */
    public function test_update_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->create();
        $editedVinculacionLaboral = VinculacionLaboral::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/vinculacion_laborals/'.$vinculacionLaboral->id,
            $editedVinculacionLaboral
        );

        $this->assertApiResponse($editedVinculacionLaboral);
    }

    /**
     * @test
     */
    public function test_delete_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/vinculacion_laborals/'.$vinculacionLaboral->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/vinculacion_laborals/'.$vinculacionLaboral->id
        );

        $this->response->assertStatus(404);
    }
}
