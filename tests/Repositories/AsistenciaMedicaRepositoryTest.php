<?php namespace Tests\Repositories;

use App\Models\AsistenciaMedica;
use App\Repositories\AsistenciaMedicaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AsistenciaMedicaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AsistenciaMedicaRepository
     */
    protected $asistenciaMedicaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->asistenciaMedicaRepo = \App::make(AsistenciaMedicaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->make()->toArray();

        $createdAsistenciaMedica = $this->asistenciaMedicaRepo->create($asistenciaMedica);

        $createdAsistenciaMedica = $createdAsistenciaMedica->toArray();
        $this->assertArrayHasKey('id', $createdAsistenciaMedica);
        $this->assertNotNull($createdAsistenciaMedica['id'], 'Created AsistenciaMedica must have id specified');
        $this->assertNotNull(AsistenciaMedica::find($createdAsistenciaMedica['id']), 'AsistenciaMedica with given id must be in DB');
        $this->assertModelData($asistenciaMedica, $createdAsistenciaMedica);
    }

    /**
     * @test read
     */
    public function test_read_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->create();

        $dbAsistenciaMedica = $this->asistenciaMedicaRepo->find($asistenciaMedica->id);

        $dbAsistenciaMedica = $dbAsistenciaMedica->toArray();
        $this->assertModelData($asistenciaMedica->toArray(), $dbAsistenciaMedica);
    }

    /**
     * @test update
     */
    public function test_update_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->create();
        $fakeAsistenciaMedica = AsistenciaMedica::factory()->make()->toArray();

        $updatedAsistenciaMedica = $this->asistenciaMedicaRepo->update($fakeAsistenciaMedica, $asistenciaMedica->id);

        $this->assertModelData($fakeAsistenciaMedica, $updatedAsistenciaMedica->toArray());
        $dbAsistenciaMedica = $this->asistenciaMedicaRepo->find($asistenciaMedica->id);
        $this->assertModelData($fakeAsistenciaMedica, $dbAsistenciaMedica->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_asistencia_medica()
    {
        $asistenciaMedica = AsistenciaMedica::factory()->create();

        $resp = $this->asistenciaMedicaRepo->delete($asistenciaMedica->id);

        $this->assertTrue($resp);
        $this->assertNull(AsistenciaMedica::find($asistenciaMedica->id), 'AsistenciaMedica should not exist in DB');
    }
}
