<?php namespace Tests\Repositories;

use App\Models\Legajo;
use App\Repositories\LegajoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LegajoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LegajoRepository
     */
    protected $legajoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->legajoRepo = \App::make(LegajoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_legajo()
    {
        $legajo = Legajo::factory()->make()->toArray();

        $createdLegajo = $this->legajoRepo->create($legajo);

        $createdLegajo = $createdLegajo->toArray();
        $this->assertArrayHasKey('id', $createdLegajo);
        $this->assertNotNull($createdLegajo['id'], 'Created Legajo must have id specified');
        $this->assertNotNull(Legajo::find($createdLegajo['id']), 'Legajo with given id must be in DB');
        $this->assertModelData($legajo, $createdLegajo);
    }

    /**
     * @test read
     */
    public function test_read_legajo()
    {
        $legajo = Legajo::factory()->create();

        $dbLegajo = $this->legajoRepo->find($legajo->id);

        $dbLegajo = $dbLegajo->toArray();
        $this->assertModelData($legajo->toArray(), $dbLegajo);
    }

    /**
     * @test update
     */
    public function test_update_legajo()
    {
        $legajo = Legajo::factory()->create();
        $fakeLegajo = Legajo::factory()->make()->toArray();

        $updatedLegajo = $this->legajoRepo->update($fakeLegajo, $legajo->id);

        $this->assertModelData($fakeLegajo, $updatedLegajo->toArray());
        $dbLegajo = $this->legajoRepo->find($legajo->id);
        $this->assertModelData($fakeLegajo, $dbLegajo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_legajo()
    {
        $legajo = Legajo::factory()->create();

        $resp = $this->legajoRepo->delete($legajo->id);

        $this->assertTrue($resp);
        $this->assertNull(Legajo::find($legajo->id), 'Legajo should not exist in DB');
    }
}
