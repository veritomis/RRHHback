<?php namespace Tests\Repositories;

use App\Models\Carrera;
use App\Repositories\CarreraRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CarreraRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CarreraRepository
     */
    protected $carreraRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->carreraRepo = \App::make(CarreraRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_carrera()
    {
        $carrera = Carrera::factory()->make()->toArray();

        $createdCarrera = $this->carreraRepo->create($carrera);

        $createdCarrera = $createdCarrera->toArray();
        $this->assertArrayHasKey('id', $createdCarrera);
        $this->assertNotNull($createdCarrera['id'], 'Created Carrera must have id specified');
        $this->assertNotNull(Carrera::find($createdCarrera['id']), 'Carrera with given id must be in DB');
        $this->assertModelData($carrera, $createdCarrera);
    }

    /**
     * @test read
     */
    public function test_read_carrera()
    {
        $carrera = Carrera::factory()->create();

        $dbCarrera = $this->carreraRepo->find($carrera->id);

        $dbCarrera = $dbCarrera->toArray();
        $this->assertModelData($carrera->toArray(), $dbCarrera);
    }

    /**
     * @test update
     */
    public function test_update_carrera()
    {
        $carrera = Carrera::factory()->create();
        $fakeCarrera = Carrera::factory()->make()->toArray();

        $updatedCarrera = $this->carreraRepo->update($fakeCarrera, $carrera->id);

        $this->assertModelData($fakeCarrera, $updatedCarrera->toArray());
        $dbCarrera = $this->carreraRepo->find($carrera->id);
        $this->assertModelData($fakeCarrera, $dbCarrera->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_carrera()
    {
        $carrera = Carrera::factory()->create();

        $resp = $this->carreraRepo->delete($carrera->id);

        $this->assertTrue($resp);
        $this->assertNull(Carrera::find($carrera->id), 'Carrera should not exist in DB');
    }
}
