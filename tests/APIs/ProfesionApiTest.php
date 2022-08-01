<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Profesion;

class ProfesionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_profesion()
    {
        $profesion = Profesion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/profesions', $profesion
        );

        $this->assertApiResponse($profesion);
    }

    /**
     * @test
     */
    public function test_read_profesion()
    {
        $profesion = Profesion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/profesions/'.$profesion->id
        );

        $this->assertApiResponse($profesion->toArray());
    }

    /**
     * @test
     */
    public function test_update_profesion()
    {
        $profesion = Profesion::factory()->create();
        $editedProfesion = Profesion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/profesions/'.$profesion->id,
            $editedProfesion
        );

        $this->assertApiResponse($editedProfesion);
    }

    /**
     * @test
     */
    public function test_delete_profesion()
    {
        $profesion = Profesion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/profesions/'.$profesion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/profesions/'.$profesion->id
        );

        $this->response->assertStatus(404);
    }
}
