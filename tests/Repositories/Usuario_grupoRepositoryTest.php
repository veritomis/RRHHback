<?php namespace Tests\Repositories;

use App\Models\Usuario_grupo;
use App\Repositories\Usuario_grupoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Usuario_grupoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Usuario_grupoRepository
     */
    protected $usuarioGrupoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->usuarioGrupoRepo = \App::make(Usuario_grupoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->make()->toArray();

        $createdUsuario_grupo = $this->usuarioGrupoRepo->create($usuarioGrupo);

        $createdUsuario_grupo = $createdUsuario_grupo->toArray();
        $this->assertArrayHasKey('id', $createdUsuario_grupo);
        $this->assertNotNull($createdUsuario_grupo['id'], 'Created Usuario_grupo must have id specified');
        $this->assertNotNull(Usuario_grupo::find($createdUsuario_grupo['id']), 'Usuario_grupo with given id must be in DB');
        $this->assertModelData($usuarioGrupo, $createdUsuario_grupo);
    }

    /**
     * @test read
     */
    public function test_read_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->create();

        $dbUsuario_grupo = $this->usuarioGrupoRepo->find($usuarioGrupo->id);

        $dbUsuario_grupo = $dbUsuario_grupo->toArray();
        $this->assertModelData($usuarioGrupo->toArray(), $dbUsuario_grupo);
    }

    /**
     * @test update
     */
    public function test_update_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->create();
        $fakeUsuario_grupo = Usuario_grupo::factory()->make()->toArray();

        $updatedUsuario_grupo = $this->usuarioGrupoRepo->update($fakeUsuario_grupo, $usuarioGrupo->id);

        $this->assertModelData($fakeUsuario_grupo, $updatedUsuario_grupo->toArray());
        $dbUsuario_grupo = $this->usuarioGrupoRepo->find($usuarioGrupo->id);
        $this->assertModelData($fakeUsuario_grupo, $dbUsuario_grupo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_usuario_grupo()
    {
        $usuarioGrupo = Usuario_grupo::factory()->create();

        $resp = $this->usuarioGrupoRepo->delete($usuarioGrupo->id);

        $this->assertTrue($resp);
        $this->assertNull(Usuario_grupo::find($usuarioGrupo->id), 'Usuario_grupo should not exist in DB');
    }
}
