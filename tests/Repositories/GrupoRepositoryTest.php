<?php namespace Tests\Repositories;

use App\Models\Grupo;
use App\Repositories\GrupoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GrupoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GrupoRepository
     */
    protected $grupoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->grupoRepo = \App::make(GrupoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_grupo()
    {
        $grupo = Grupo::factory()->make()->toArray();

        $createdGrupo = $this->grupoRepo->create($grupo);

        $createdGrupo = $createdGrupo->toArray();
        $this->assertArrayHasKey('id', $createdGrupo);
        $this->assertNotNull($createdGrupo['id'], 'Created Grupo must have id specified');
        $this->assertNotNull(Grupo::find($createdGrupo['id']), 'Grupo with given id must be in DB');
        $this->assertModelData($grupo, $createdGrupo);
    }

    /**
     * @test read
     */
    public function test_read_grupo()
    {
        $grupo = Grupo::factory()->create();

        $dbGrupo = $this->grupoRepo->find($grupo->id);

        $dbGrupo = $dbGrupo->toArray();
        $this->assertModelData($grupo->toArray(), $dbGrupo);
    }

    /**
     * @test update
     */
    public function test_update_grupo()
    {
        $grupo = Grupo::factory()->create();
        $fakeGrupo = Grupo::factory()->make()->toArray();

        $updatedGrupo = $this->grupoRepo->update($fakeGrupo, $grupo->id);

        $this->assertModelData($fakeGrupo, $updatedGrupo->toArray());
        $dbGrupo = $this->grupoRepo->find($grupo->id);
        $this->assertModelData($fakeGrupo, $dbGrupo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_grupo()
    {
        $grupo = Grupo::factory()->create();

        $resp = $this->grupoRepo->delete($grupo->id);

        $this->assertTrue($resp);
        $this->assertNull(Grupo::find($grupo->id), 'Grupo should not exist in DB');
    }
}
