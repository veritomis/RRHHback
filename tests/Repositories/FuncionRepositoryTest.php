<?php namespace Tests\Repositories;

use App\Models\Funcion;
use App\Repositories\FuncionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FuncionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FuncionRepository
     */
    protected $funcionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->funcionRepo = \App::make(FuncionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_funcion()
    {
        $funcion = Funcion::factory()->make()->toArray();

        $createdFuncion = $this->funcionRepo->create($funcion);

        $createdFuncion = $createdFuncion->toArray();
        $this->assertArrayHasKey('id', $createdFuncion);
        $this->assertNotNull($createdFuncion['id'], 'Created Funcion must have id specified');
        $this->assertNotNull(Funcion::find($createdFuncion['id']), 'Funcion with given id must be in DB');
        $this->assertModelData($funcion, $createdFuncion);
    }

    /**
     * @test read
     */
    public function test_read_funcion()
    {
        $funcion = Funcion::factory()->create();

        $dbFuncion = $this->funcionRepo->find($funcion->id);

        $dbFuncion = $dbFuncion->toArray();
        $this->assertModelData($funcion->toArray(), $dbFuncion);
    }

    /**
     * @test update
     */
    public function test_update_funcion()
    {
        $funcion = Funcion::factory()->create();
        $fakeFuncion = Funcion::factory()->make()->toArray();

        $updatedFuncion = $this->funcionRepo->update($fakeFuncion, $funcion->id);

        $this->assertModelData($fakeFuncion, $updatedFuncion->toArray());
        $dbFuncion = $this->funcionRepo->find($funcion->id);
        $this->assertModelData($fakeFuncion, $dbFuncion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_funcion()
    {
        $funcion = Funcion::factory()->create();

        $resp = $this->funcionRepo->delete($funcion->id);

        $this->assertTrue($resp);
        $this->assertNull(Funcion::find($funcion->id), 'Funcion should not exist in DB');
    }
}
