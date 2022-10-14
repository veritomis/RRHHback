<?php namespace Tests\Repositories;

use App\Models\Evaluacion;
use App\Repositories\EvaluacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EvaluacionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EvaluacionRepository
     */
    protected $evaluacionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->evaluacionRepo = \App::make(EvaluacionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->make()->toArray();

        $createdEvaluacion = $this->evaluacionRepo->create($evaluacion);

        $createdEvaluacion = $createdEvaluacion->toArray();
        $this->assertArrayHasKey('id', $createdEvaluacion);
        $this->assertNotNull($createdEvaluacion['id'], 'Created Evaluacion must have id specified');
        $this->assertNotNull(Evaluacion::find($createdEvaluacion['id']), 'Evaluacion with given id must be in DB');
        $this->assertModelData($evaluacion, $createdEvaluacion);
    }

    /**
     * @test read
     */
    public function test_read_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->create();

        $dbEvaluacion = $this->evaluacionRepo->find($evaluacion->id);

        $dbEvaluacion = $dbEvaluacion->toArray();
        $this->assertModelData($evaluacion->toArray(), $dbEvaluacion);
    }

    /**
     * @test update
     */
    public function test_update_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->create();
        $fakeEvaluacion = Evaluacion::factory()->make()->toArray();

        $updatedEvaluacion = $this->evaluacionRepo->update($fakeEvaluacion, $evaluacion->id);

        $this->assertModelData($fakeEvaluacion, $updatedEvaluacion->toArray());
        $dbEvaluacion = $this->evaluacionRepo->find($evaluacion->id);
        $this->assertModelData($fakeEvaluacion, $dbEvaluacion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evaluacion()
    {
        $evaluacion = Evaluacion::factory()->create();

        $resp = $this->evaluacionRepo->delete($evaluacion->id);

        $this->assertTrue($resp);
        $this->assertNull(Evaluacion::find($evaluacion->id), 'Evaluacion should not exist in DB');
    }
}
