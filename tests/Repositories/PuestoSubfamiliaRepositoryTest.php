<?php namespace Tests\Repositories;

use App\Models\PuestoSubfamilia;
use App\Repositories\PuestoSubfamiliaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PuestoSubfamiliaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PuestoSubfamiliaRepository
     */
    protected $puestoSubfamiliaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->puestoSubfamiliaRepo = \App::make(PuestoSubfamiliaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->make()->toArray();

        $createdPuestoSubfamilia = $this->puestoSubfamiliaRepo->create($puestoSubfamilia);

        $createdPuestoSubfamilia = $createdPuestoSubfamilia->toArray();
        $this->assertArrayHasKey('id', $createdPuestoSubfamilia);
        $this->assertNotNull($createdPuestoSubfamilia['id'], 'Created PuestoSubfamilia must have id specified');
        $this->assertNotNull(PuestoSubfamilia::find($createdPuestoSubfamilia['id']), 'PuestoSubfamilia with given id must be in DB');
        $this->assertModelData($puestoSubfamilia, $createdPuestoSubfamilia);
    }

    /**
     * @test read
     */
    public function test_read_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->create();

        $dbPuestoSubfamilia = $this->puestoSubfamiliaRepo->find($puestoSubfamilia->id);

        $dbPuestoSubfamilia = $dbPuestoSubfamilia->toArray();
        $this->assertModelData($puestoSubfamilia->toArray(), $dbPuestoSubfamilia);
    }

    /**
     * @test update
     */
    public function test_update_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->create();
        $fakePuestoSubfamilia = PuestoSubfamilia::factory()->make()->toArray();

        $updatedPuestoSubfamilia = $this->puestoSubfamiliaRepo->update($fakePuestoSubfamilia, $puestoSubfamilia->id);

        $this->assertModelData($fakePuestoSubfamilia, $updatedPuestoSubfamilia->toArray());
        $dbPuestoSubfamilia = $this->puestoSubfamiliaRepo->find($puestoSubfamilia->id);
        $this->assertModelData($fakePuestoSubfamilia, $dbPuestoSubfamilia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_puesto_subfamilia()
    {
        $puestoSubfamilia = PuestoSubfamilia::factory()->create();

        $resp = $this->puestoSubfamiliaRepo->delete($puestoSubfamilia->id);

        $this->assertTrue($resp);
        $this->assertNull(PuestoSubfamilia::find($puestoSubfamilia->id), 'PuestoSubfamilia should not exist in DB');
    }
}
