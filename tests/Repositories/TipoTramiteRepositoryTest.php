<?php namespace Tests\Repositories;

use App\Models\TipoTramite;
use App\Repositories\TipoTramiteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoTramiteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoTramiteRepository
     */
    protected $tipoTramiteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoTramiteRepo = \App::make(TipoTramiteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->make()->toArray();

        $createdTipoTramite = $this->tipoTramiteRepo->create($tipoTramite);

        $createdTipoTramite = $createdTipoTramite->toArray();
        $this->assertArrayHasKey('id', $createdTipoTramite);
        $this->assertNotNull($createdTipoTramite['id'], 'Created TipoTramite must have id specified');
        $this->assertNotNull(TipoTramite::find($createdTipoTramite['id']), 'TipoTramite with given id must be in DB');
        $this->assertModelData($tipoTramite, $createdTipoTramite);
    }

    /**
     * @test read
     */
    public function test_read_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->create();

        $dbTipoTramite = $this->tipoTramiteRepo->find($tipoTramite->id);

        $dbTipoTramite = $dbTipoTramite->toArray();
        $this->assertModelData($tipoTramite->toArray(), $dbTipoTramite);
    }

    /**
     * @test update
     */
    public function test_update_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->create();
        $fakeTipoTramite = TipoTramite::factory()->make()->toArray();

        $updatedTipoTramite = $this->tipoTramiteRepo->update($fakeTipoTramite, $tipoTramite->id);

        $this->assertModelData($fakeTipoTramite, $updatedTipoTramite->toArray());
        $dbTipoTramite = $this->tipoTramiteRepo->find($tipoTramite->id);
        $this->assertModelData($fakeTipoTramite, $dbTipoTramite->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_tramite()
    {
        $tipoTramite = TipoTramite::factory()->create();

        $resp = $this->tipoTramiteRepo->delete($tipoTramite->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoTramite::find($tipoTramite->id), 'TipoTramite should not exist in DB');
    }
}
