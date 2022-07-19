<?php namespace Tests\Repositories;

use App\Models\Profesion;
use App\Repositories\ProfesionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProfesionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProfesionRepository
     */
    protected $profesionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->profesionRepo = \App::make(ProfesionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_profesion()
    {
        $profesion = Profesion::factory()->make()->toArray();

        $createdProfesion = $this->profesionRepo->create($profesion);

        $createdProfesion = $createdProfesion->toArray();
        $this->assertArrayHasKey('id', $createdProfesion);
        $this->assertNotNull($createdProfesion['id'], 'Created Profesion must have id specified');
        $this->assertNotNull(Profesion::find($createdProfesion['id']), 'Profesion with given id must be in DB');
        $this->assertModelData($profesion, $createdProfesion);
    }

    /**
     * @test read
     */
    public function test_read_profesion()
    {
        $profesion = Profesion::factory()->create();

        $dbProfesion = $this->profesionRepo->find($profesion->id);

        $dbProfesion = $dbProfesion->toArray();
        $this->assertModelData($profesion->toArray(), $dbProfesion);
    }

    /**
     * @test update
     */
    public function test_update_profesion()
    {
        $profesion = Profesion::factory()->create();
        $fakeProfesion = Profesion::factory()->make()->toArray();

        $updatedProfesion = $this->profesionRepo->update($fakeProfesion, $profesion->id);

        $this->assertModelData($fakeProfesion, $updatedProfesion->toArray());
        $dbProfesion = $this->profesionRepo->find($profesion->id);
        $this->assertModelData($fakeProfesion, $dbProfesion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_profesion()
    {
        $profesion = Profesion::factory()->create();

        $resp = $this->profesionRepo->delete($profesion->id);

        $this->assertTrue($resp);
        $this->assertNull(Profesion::find($profesion->id), 'Profesion should not exist in DB');
    }
}
