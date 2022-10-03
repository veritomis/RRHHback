<?php namespace Tests\Repositories;

use App\Models\Asitencia;
use App\Repositories\AsitenciaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AsitenciaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AsitenciaRepository
     */
    protected $asitenciaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->asitenciaRepo = \App::make(AsitenciaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_asitencia()
    {
        $asitencia = Asitencia::factory()->make()->toArray();

        $createdAsitencia = $this->asitenciaRepo->create($asitencia);

        $createdAsitencia = $createdAsitencia->toArray();
        $this->assertArrayHasKey('id', $createdAsitencia);
        $this->assertNotNull($createdAsitencia['id'], 'Created Asitencia must have id specified');
        $this->assertNotNull(Asitencia::find($createdAsitencia['id']), 'Asitencia with given id must be in DB');
        $this->assertModelData($asitencia, $createdAsitencia);
    }

    /**
     * @test read
     */
    public function test_read_asitencia()
    {
        $asitencia = Asitencia::factory()->create();

        $dbAsitencia = $this->asitenciaRepo->find($asitencia->id);

        $dbAsitencia = $dbAsitencia->toArray();
        $this->assertModelData($asitencia->toArray(), $dbAsitencia);
    }

    /**
     * @test update
     */
    public function test_update_asitencia()
    {
        $asitencia = Asitencia::factory()->create();
        $fakeAsitencia = Asitencia::factory()->make()->toArray();

        $updatedAsitencia = $this->asitenciaRepo->update($fakeAsitencia, $asitencia->id);

        $this->assertModelData($fakeAsitencia, $updatedAsitencia->toArray());
        $dbAsitencia = $this->asitenciaRepo->find($asitencia->id);
        $this->assertModelData($fakeAsitencia, $dbAsitencia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_asitencia()
    {
        $asitencia = Asitencia::factory()->create();

        $resp = $this->asitenciaRepo->delete($asitencia->id);

        $this->assertTrue($resp);
        $this->assertNull(Asitencia::find($asitencia->id), 'Asitencia should not exist in DB');
    }
}
