<?php namespace Tests\Repositories;

use App\Models\Contrato;
use App\Repositories\ContratoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContratoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContratoRepository
     */
    protected $contratoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contratoRepo = \App::make(ContratoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contrato()
    {
        $contrato = Contrato::factory()->make()->toArray();

        $createdContrato = $this->contratoRepo->create($contrato);

        $createdContrato = $createdContrato->toArray();
        $this->assertArrayHasKey('id', $createdContrato);
        $this->assertNotNull($createdContrato['id'], 'Created Contrato must have id specified');
        $this->assertNotNull(Contrato::find($createdContrato['id']), 'Contrato with given id must be in DB');
        $this->assertModelData($contrato, $createdContrato);
    }

    /**
     * @test read
     */
    public function test_read_contrato()
    {
        $contrato = Contrato::factory()->create();

        $dbContrato = $this->contratoRepo->find($contrato->id);

        $dbContrato = $dbContrato->toArray();
        $this->assertModelData($contrato->toArray(), $dbContrato);
    }

    /**
     * @test update
     */
    public function test_update_contrato()
    {
        $contrato = Contrato::factory()->create();
        $fakeContrato = Contrato::factory()->make()->toArray();

        $updatedContrato = $this->contratoRepo->update($fakeContrato, $contrato->id);

        $this->assertModelData($fakeContrato, $updatedContrato->toArray());
        $dbContrato = $this->contratoRepo->find($contrato->id);
        $this->assertModelData($fakeContrato, $dbContrato->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_contrato()
    {
        $contrato = Contrato::factory()->create();

        $resp = $this->contratoRepo->delete($contrato->id);

        $this->assertTrue($resp);
        $this->assertNull(Contrato::find($contrato->id), 'Contrato should not exist in DB');
    }
}
