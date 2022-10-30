<?php namespace Tests\Repositories;

use App\Models\Asistencia;
use App\Repositories\AsistenciaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AsistenciaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AsistenciaRepository
     */
    protected $asistenciaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->asistenciaRepo = \App::make(AsistenciaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_asistencia()
    {
        $asistencia = Asistencia::factory()->make()->toArray();

        $createdAsistencia = $this->asistenciaRepo->create($asistencia);

        $createdAsistencia = $createdAsistencia->toArray();
        $this->assertArrayHasKey('id', $createdAsistencia);
        $this->assertNotNull($createdAsistencia['id'], 'Created Asistencia must have id specified');
        $this->assertNotNull(Asistencia::find($createdAsistencia['id']), 'Asistencia with given id must be in DB');
        $this->assertModelData($asistencia, $createdAsistencia);
    }

    /**
     * @test read
     */
    public function test_read_asistencia()
    {
        $asistencia = Asistencia::factory()->create();

        $dbAsistencia = $this->asistenciaRepo->find($asistencia->id);

        $dbAsistencia = $dbAsistencia->toArray();
        $this->assertModelData($asistencia->toArray(), $dbAsistencia);
    }

    /**
     * @test update
     */
    public function test_update_asistencia()
    {
        $asistencia = Asistencia::factory()->create();
        $fakeAsistencia = Asistencia::factory()->make()->toArray();

        $updatedAsistencia = $this->asistenciaRepo->update($fakeAsistencia, $asistencia->id);

        $this->assertModelData($fakeAsistencia, $updatedAsistencia->toArray());
        $dbAsistencia = $this->asistenciaRepo->find($asistencia->id);
        $this->assertModelData($fakeAsistencia, $dbAsistencia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_asistencia()
    {
        $asistencia = Asistencia::factory()->create();

        $resp = $this->asistenciaRepo->delete($asistencia->id);

        $this->assertTrue($resp);
        $this->assertNull(Asistencia::find($asistencia->id), 'Asistencia should not exist in DB');
    }
}
