<?php namespace Tests\Repositories;

use App\Models\Capacitacion;
use App\Repositories\CapacitacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CapacitacionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CapacitacionRepository
     */
    protected $capacitacionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->capacitacionRepo = \App::make(CapacitacionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->make()->toArray();

        $createdCapacitacion = $this->capacitacionRepo->create($capacitacion);

        $createdCapacitacion = $createdCapacitacion->toArray();
        $this->assertArrayHasKey('id', $createdCapacitacion);
        $this->assertNotNull($createdCapacitacion['id'], 'Created Capacitacion must have id specified');
        $this->assertNotNull(Capacitacion::find($createdCapacitacion['id']), 'Capacitacion with given id must be in DB');
        $this->assertModelData($capacitacion, $createdCapacitacion);
    }

    /**
     * @test read
     */
    public function test_read_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->create();

        $dbCapacitacion = $this->capacitacionRepo->find($capacitacion->id);

        $dbCapacitacion = $dbCapacitacion->toArray();
        $this->assertModelData($capacitacion->toArray(), $dbCapacitacion);
    }

    /**
     * @test update
     */
    public function test_update_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->create();
        $fakeCapacitacion = Capacitacion::factory()->make()->toArray();

        $updatedCapacitacion = $this->capacitacionRepo->update($fakeCapacitacion, $capacitacion->id);

        $this->assertModelData($fakeCapacitacion, $updatedCapacitacion->toArray());
        $dbCapacitacion = $this->capacitacionRepo->find($capacitacion->id);
        $this->assertModelData($fakeCapacitacion, $dbCapacitacion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_capacitacion()
    {
        $capacitacion = Capacitacion::factory()->create();

        $resp = $this->capacitacionRepo->delete($capacitacion->id);

        $this->assertTrue($resp);
        $this->assertNull(Capacitacion::find($capacitacion->id), 'Capacitacion should not exist in DB');
    }
}
