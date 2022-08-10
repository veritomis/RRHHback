<?php namespace Tests\Repositories;

use App\Models\PuestoNomenclatura;
use App\Repositories\PuestoNomenclaturaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PuestoNomenclaturaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PuestoNomenclaturaRepository
     */
    protected $puestoNomenclaturaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->puestoNomenclaturaRepo = \App::make(PuestoNomenclaturaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->make()->toArray();

        $createdPuestoNomenclatura = $this->puestoNomenclaturaRepo->create($puestoNomenclatura);

        $createdPuestoNomenclatura = $createdPuestoNomenclatura->toArray();
        $this->assertArrayHasKey('id', $createdPuestoNomenclatura);
        $this->assertNotNull($createdPuestoNomenclatura['id'], 'Created PuestoNomenclatura must have id specified');
        $this->assertNotNull(PuestoNomenclatura::find($createdPuestoNomenclatura['id']), 'PuestoNomenclatura with given id must be in DB');
        $this->assertModelData($puestoNomenclatura, $createdPuestoNomenclatura);
    }

    /**
     * @test read
     */
    public function test_read_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->create();

        $dbPuestoNomenclatura = $this->puestoNomenclaturaRepo->find($puestoNomenclatura->id);

        $dbPuestoNomenclatura = $dbPuestoNomenclatura->toArray();
        $this->assertModelData($puestoNomenclatura->toArray(), $dbPuestoNomenclatura);
    }

    /**
     * @test update
     */
    public function test_update_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->create();
        $fakePuestoNomenclatura = PuestoNomenclatura::factory()->make()->toArray();

        $updatedPuestoNomenclatura = $this->puestoNomenclaturaRepo->update($fakePuestoNomenclatura, $puestoNomenclatura->id);

        $this->assertModelData($fakePuestoNomenclatura, $updatedPuestoNomenclatura->toArray());
        $dbPuestoNomenclatura = $this->puestoNomenclaturaRepo->find($puestoNomenclatura->id);
        $this->assertModelData($fakePuestoNomenclatura, $dbPuestoNomenclatura->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_puesto_nomenclatura()
    {
        $puestoNomenclatura = PuestoNomenclatura::factory()->create();

        $resp = $this->puestoNomenclaturaRepo->delete($puestoNomenclatura->id);

        $this->assertTrue($resp);
        $this->assertNull(PuestoNomenclatura::find($puestoNomenclatura->id), 'PuestoNomenclatura should not exist in DB');
    }
}
