<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Titulo;

class TituloApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_titulo()
    {
        $titulo = Titulo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/titulos', $titulo
        );

        $this->assertApiResponse($titulo);
    }

    /**
     * @test
     */
    public function test_read_titulo()
    {
        $titulo = Titulo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/titulos/'.$titulo->id
        );

        $this->assertApiResponse($titulo->toArray());
    }

    /**
     * @test
     */
    public function test_update_titulo()
    {
        $titulo = Titulo::factory()->create();
        $editedTitulo = Titulo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/titulos/'.$titulo->id,
            $editedTitulo
        );

        $this->assertApiResponse($editedTitulo);
    }

    /**
     * @test
     */
    public function test_delete_titulo()
    {
        $titulo = Titulo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/titulos/'.$titulo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/titulos/'.$titulo->id
        );

        $this->response->assertStatus(404);
    }
}
