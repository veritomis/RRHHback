<?php namespace Tests\Repositories;

use App\Models\TipoContrato;
use App\Repositories\TipoContratoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoContratoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoContratoRepository
     */
    protected $tipoContratoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoContratoRepo = \App::make(TipoContratoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->make()->toArray();

        $createdTipoContrato = $this->tipoContratoRepo->create($tipoContrato);

        $createdTipoContrato = $createdTipoContrato->toArray();
        $this->assertArrayHasKey('id', $createdTipoContrato);
        $this->assertNotNull($createdTipoContrato['id'], 'Created TipoContrato must have id specified');
        $this->assertNotNull(TipoContrato::find($createdTipoContrato['id']), 'TipoContrato with given id must be in DB');
        $this->assertModelData($tipoContrato, $createdTipoContrato);
    }

    /**
     * @test read
     */
    public function test_read_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->create();

        $dbTipoContrato = $this->tipoContratoRepo->find($tipoContrato->id);

        $dbTipoContrato = $dbTipoContrato->toArray();
        $this->assertModelData($tipoContrato->toArray(), $dbTipoContrato);
    }

    /**
     * @test update
     */
    public function test_update_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->create();
        $fakeTipoContrato = TipoContrato::factory()->make()->toArray();

        $updatedTipoContrato = $this->tipoContratoRepo->update($fakeTipoContrato, $tipoContrato->id);

        $this->assertModelData($fakeTipoContrato, $updatedTipoContrato->toArray());
        $dbTipoContrato = $this->tipoContratoRepo->find($tipoContrato->id);
        $this->assertModelData($fakeTipoContrato, $dbTipoContrato->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_contrato()
    {
        $tipoContrato = TipoContrato::factory()->create();

        $resp = $this->tipoContratoRepo->delete($tipoContrato->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoContrato::find($tipoContrato->id), 'TipoContrato should not exist in DB');
    }
}
