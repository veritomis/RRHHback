<?php namespace Tests\Repositories;

use App\Models\Liquidacion;
use App\Repositories\LiquidacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LiquidacionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LiquidacionRepository
     */
    protected $liquidacionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->liquidacionRepo = \App::make(LiquidacionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->make()->toArray();

        $createdLiquidacion = $this->liquidacionRepo->create($liquidacion);

        $createdLiquidacion = $createdLiquidacion->toArray();
        $this->assertArrayHasKey('id', $createdLiquidacion);
        $this->assertNotNull($createdLiquidacion['id'], 'Created Liquidacion must have id specified');
        $this->assertNotNull(Liquidacion::find($createdLiquidacion['id']), 'Liquidacion with given id must be in DB');
        $this->assertModelData($liquidacion, $createdLiquidacion);
    }

    /**
     * @test read
     */
    public function test_read_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->create();

        $dbLiquidacion = $this->liquidacionRepo->find($liquidacion->id);

        $dbLiquidacion = $dbLiquidacion->toArray();
        $this->assertModelData($liquidacion->toArray(), $dbLiquidacion);
    }

    /**
     * @test update
     */
    public function test_update_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->create();
        $fakeLiquidacion = Liquidacion::factory()->make()->toArray();

        $updatedLiquidacion = $this->liquidacionRepo->update($fakeLiquidacion, $liquidacion->id);

        $this->assertModelData($fakeLiquidacion, $updatedLiquidacion->toArray());
        $dbLiquidacion = $this->liquidacionRepo->find($liquidacion->id);
        $this->assertModelData($fakeLiquidacion, $dbLiquidacion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_liquidacion()
    {
        $liquidacion = Liquidacion::factory()->create();

        $resp = $this->liquidacionRepo->delete($liquidacion->id);

        $this->assertTrue($resp);
        $this->assertNull(Liquidacion::find($liquidacion->id), 'Liquidacion should not exist in DB');
    }
}
