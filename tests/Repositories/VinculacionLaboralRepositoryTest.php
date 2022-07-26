<?php namespace Tests\Repositories;

use App\Models\VinculacionLaboral;
use App\Repositories\VinculacionLaboralRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class VinculacionLaboralRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var VinculacionLaboralRepository
     */
    protected $vinculacionLaboralRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->vinculacionLaboralRepo = \App::make(VinculacionLaboralRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->make()->toArray();

        $createdVinculacionLaboral = $this->vinculacionLaboralRepo->create($vinculacionLaboral);

        $createdVinculacionLaboral = $createdVinculacionLaboral->toArray();
        $this->assertArrayHasKey('id', $createdVinculacionLaboral);
        $this->assertNotNull($createdVinculacionLaboral['id'], 'Created VinculacionLaboral must have id specified');
        $this->assertNotNull(VinculacionLaboral::find($createdVinculacionLaboral['id']), 'VinculacionLaboral with given id must be in DB');
        $this->assertModelData($vinculacionLaboral, $createdVinculacionLaboral);
    }

    /**
     * @test read
     */
    public function test_read_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->create();

        $dbVinculacionLaboral = $this->vinculacionLaboralRepo->find($vinculacionLaboral->id);

        $dbVinculacionLaboral = $dbVinculacionLaboral->toArray();
        $this->assertModelData($vinculacionLaboral->toArray(), $dbVinculacionLaboral);
    }

    /**
     * @test update
     */
    public function test_update_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->create();
        $fakeVinculacionLaboral = VinculacionLaboral::factory()->make()->toArray();

        $updatedVinculacionLaboral = $this->vinculacionLaboralRepo->update($fakeVinculacionLaboral, $vinculacionLaboral->id);

        $this->assertModelData($fakeVinculacionLaboral, $updatedVinculacionLaboral->toArray());
        $dbVinculacionLaboral = $this->vinculacionLaboralRepo->find($vinculacionLaboral->id);
        $this->assertModelData($fakeVinculacionLaboral, $dbVinculacionLaboral->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_vinculacion_laboral()
    {
        $vinculacionLaboral = VinculacionLaboral::factory()->create();

        $resp = $this->vinculacionLaboralRepo->delete($vinculacionLaboral->id);

        $this->assertTrue($resp);
        $this->assertNull(VinculacionLaboral::find($vinculacionLaboral->id), 'VinculacionLaboral should not exist in DB');
    }
}
