<?php namespace Tests\Repositories;

use App\Models\PuestoFamilia;
use App\Repositories\PuestoFamiliaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PuestoFamiliaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PuestoFamiliaRepository
     */
    protected $puestoFamiliaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->puestoFamiliaRepo = \App::make(PuestoFamiliaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->make()->toArray();

        $createdPuestoFamilia = $this->puestoFamiliaRepo->create($puestoFamilia);

        $createdPuestoFamilia = $createdPuestoFamilia->toArray();
        $this->assertArrayHasKey('id', $createdPuestoFamilia);
        $this->assertNotNull($createdPuestoFamilia['id'], 'Created PuestoFamilia must have id specified');
        $this->assertNotNull(PuestoFamilia::find($createdPuestoFamilia['id']), 'PuestoFamilia with given id must be in DB');
        $this->assertModelData($puestoFamilia, $createdPuestoFamilia);
    }

    /**
     * @test read
     */
    public function test_read_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->create();

        $dbPuestoFamilia = $this->puestoFamiliaRepo->find($puestoFamilia->id);

        $dbPuestoFamilia = $dbPuestoFamilia->toArray();
        $this->assertModelData($puestoFamilia->toArray(), $dbPuestoFamilia);
    }

    /**
     * @test update
     */
    public function test_update_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->create();
        $fakePuestoFamilia = PuestoFamilia::factory()->make()->toArray();

        $updatedPuestoFamilia = $this->puestoFamiliaRepo->update($fakePuestoFamilia, $puestoFamilia->id);

        $this->assertModelData($fakePuestoFamilia, $updatedPuestoFamilia->toArray());
        $dbPuestoFamilia = $this->puestoFamiliaRepo->find($puestoFamilia->id);
        $this->assertModelData($fakePuestoFamilia, $dbPuestoFamilia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_puesto_familia()
    {
        $puestoFamilia = PuestoFamilia::factory()->create();

        $resp = $this->puestoFamiliaRepo->delete($puestoFamilia->id);

        $this->assertTrue($resp);
        $this->assertNull(PuestoFamilia::find($puestoFamilia->id), 'PuestoFamilia should not exist in DB');
    }
}
