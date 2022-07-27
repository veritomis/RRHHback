<?php namespace Tests\Repositories;

use App\Models\AsistenciaTipoContrato;
use App\Repositories\AsistenciaTipoContratoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AsistenciaTipoContratoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AsistenciaTipoContratoRepository
     */
    protected $asistenciaTipoContratoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->asistenciaTipoContratoRepo = \App::make(AsistenciaTipoContratoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->make()->toArray();

        $createdAsistenciaTipoContrato = $this->asistenciaTipoContratoRepo->create($asistenciaTipoContrato);

        $createdAsistenciaTipoContrato = $createdAsistenciaTipoContrato->toArray();
        $this->assertArrayHasKey('id', $createdAsistenciaTipoContrato);
        $this->assertNotNull($createdAsistenciaTipoContrato['id'], 'Created AsistenciaTipoContrato must have id specified');
        $this->assertNotNull(AsistenciaTipoContrato::find($createdAsistenciaTipoContrato['id']), 'AsistenciaTipoContrato with given id must be in DB');
        $this->assertModelData($asistenciaTipoContrato, $createdAsistenciaTipoContrato);
    }

    /**
     * @test read
     */
    public function test_read_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->create();

        $dbAsistenciaTipoContrato = $this->asistenciaTipoContratoRepo->find($asistenciaTipoContrato->id);

        $dbAsistenciaTipoContrato = $dbAsistenciaTipoContrato->toArray();
        $this->assertModelData($asistenciaTipoContrato->toArray(), $dbAsistenciaTipoContrato);
    }

    /**
     * @test update
     */
    public function test_update_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->create();
        $fakeAsistenciaTipoContrato = AsistenciaTipoContrato::factory()->make()->toArray();

        $updatedAsistenciaTipoContrato = $this->asistenciaTipoContratoRepo->update($fakeAsistenciaTipoContrato, $asistenciaTipoContrato->id);

        $this->assertModelData($fakeAsistenciaTipoContrato, $updatedAsistenciaTipoContrato->toArray());
        $dbAsistenciaTipoContrato = $this->asistenciaTipoContratoRepo->find($asistenciaTipoContrato->id);
        $this->assertModelData($fakeAsistenciaTipoContrato, $dbAsistenciaTipoContrato->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_asistencia_tipo_contrato()
    {
        $asistenciaTipoContrato = AsistenciaTipoContrato::factory()->create();

        $resp = $this->asistenciaTipoContratoRepo->delete($asistenciaTipoContrato->id);

        $this->assertTrue($resp);
        $this->assertNull(AsistenciaTipoContrato::find($asistenciaTipoContrato->id), 'AsistenciaTipoContrato should not exist in DB');
    }
}
