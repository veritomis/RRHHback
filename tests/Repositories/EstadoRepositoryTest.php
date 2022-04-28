<?php namespace Tests\Repositories;

use App\Models\Estado;
use App\Repositories\EstadoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EstadoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EstadoRepository
     */
    protected $estadoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->estadoRepo = \App::make(EstadoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_estado()
    {
        $estado = Estado::factory()->make()->toArray();

        $createdEstado = $this->estadoRepo->create($estado);

        $createdEstado = $createdEstado->toArray();
        $this->assertArrayHasKey('id', $createdEstado);
        $this->assertNotNull($createdEstado['id'], 'Created Estado must have id specified');
        $this->assertNotNull(Estado::find($createdEstado['id']), 'Estado with given id must be in DB');
        $this->assertModelData($estado, $createdEstado);
    }

    /**
     * @test read
     */
    public function test_read_estado()
    {
        $estado = Estado::factory()->create();

        $dbEstado = $this->estadoRepo->find($estado->id);

        $dbEstado = $dbEstado->toArray();
        $this->assertModelData($estado->toArray(), $dbEstado);
    }

    /**
     * @test update
     */
    public function test_update_estado()
    {
        $estado = Estado::factory()->create();
        $fakeEstado = Estado::factory()->make()->toArray();

        $updatedEstado = $this->estadoRepo->update($fakeEstado, $estado->id);

        $this->assertModelData($fakeEstado, $updatedEstado->toArray());
        $dbEstado = $this->estadoRepo->find($estado->id);
        $this->assertModelData($fakeEstado, $dbEstado->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_estado()
    {
        $estado = Estado::factory()->create();

        $resp = $this->estadoRepo->delete($estado->id);

        $this->assertTrue($resp);
        $this->assertNull(Estado::find($estado->id), 'Estado should not exist in DB');
    }
}
