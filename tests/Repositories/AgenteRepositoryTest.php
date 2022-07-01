<?php namespace Tests\Repositories;

use App\Models\Agente;
use App\Repositories\AgenteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AgenteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AgenteRepository
     */
    protected $agenteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->agenteRepo = \App::make(AgenteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_agente()
    {
        $agente = Agente::factory()->make()->toArray();

        $createdAgente = $this->agenteRepo->create($agente);

        $createdAgente = $createdAgente->toArray();
        $this->assertArrayHasKey('id', $createdAgente);
        $this->assertNotNull($createdAgente['id'], 'Created Agente must have id specified');
        $this->assertNotNull(Agente::find($createdAgente['id']), 'Agente with given id must be in DB');
        $this->assertModelData($agente, $createdAgente);
    }

    /**
     * @test read
     */
    public function test_read_agente()
    {
        $agente = Agente::factory()->create();

        $dbAgente = $this->agenteRepo->find($agente->id);

        $dbAgente = $dbAgente->toArray();
        $this->assertModelData($agente->toArray(), $dbAgente);
    }

    /**
     * @test update
     */
    public function test_update_agente()
    {
        $agente = Agente::factory()->create();
        $fakeAgente = Agente::factory()->make()->toArray();

        $updatedAgente = $this->agenteRepo->update($fakeAgente, $agente->id);

        $this->assertModelData($fakeAgente, $updatedAgente->toArray());
        $dbAgente = $this->agenteRepo->find($agente->id);
        $this->assertModelData($fakeAgente, $dbAgente->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_agente()
    {
        $agente = Agente::factory()->create();

        $resp = $this->agenteRepo->delete($agente->id);

        $this->assertTrue($resp);
        $this->assertNull(Agente::find($agente->id), 'Agente should not exist in DB');
    }
}
