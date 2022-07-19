<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Usuario_grupo;

class Usuario_grupoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/usuario_grupos', $usuarioGrupo
        );

        $this->assertApiResponse($usuarioGrupo);
    }

    /**
     * @test
     */
    public function test_read_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/usuario_grupos/'.$usuarioGrupo->id
        );

        $this->assertApiResponse($usuarioGrupo->toArray());
    }

    /**
     * @test
     */
    public function test_update_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->create();
        $editedUsuario_grupo = Usuario_grupo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/usuario_grupos/'.$usuarioGrupo->id,
            $editedUsuario_grupo
        );

        $this->assertApiResponse($editedUsuario_grupo);
    }

    /**
     * @test
     */
    public function test_delete_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/usuario_grupos/'.$usuarioGrupo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/usuario_grupos/'.$usuarioGrupo->id
        );

        $this->response->assertStatus(404);
    }
}
