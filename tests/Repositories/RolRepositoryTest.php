<?php namespace Tests\Repositories;

use App\Models\Rol;
use App\Repositories\RolRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RolRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RolRepository
     */
    protected $rolRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rolRepo = \App::make(RolRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rol()
    {
        $rol = Rol::factory()->make()->toArray();

        $createdRol = $this->rolRepo->create($rol);

        $createdRol = $createdRol->toArray();
        $this->assertArrayHasKey('id', $createdRol);
        $this->assertNotNull($createdRol['id'], 'Created Rol must have id specified');
        $this->assertNotNull(Rol::find($createdRol['id']), 'Rol with given id must be in DB');
        $this->assertModelData($rol, $createdRol);
    }

    /**
     * @test read
     */
    public function test_read_rol()
    {
        $rol = Rol::factory()->create();

        $dbRol = $this->rolRepo->find($rol->id);

        $dbRol = $dbRol->toArray();
        $this->assertModelData($rol->toArray(), $dbRol);
    }

    /**
     * @test update
     */
    public function test_update_rol()
    {
        $rol = Rol::factory()->create();
        $fakeRol = Rol::factory()->make()->toArray();

        $updatedRol = $this->rolRepo->update($fakeRol, $rol->id);

        $this->assertModelData($fakeRol, $updatedRol->toArray());
        $dbRol = $this->rolRepo->find($rol->id);
        $this->assertModelData($fakeRol, $dbRol->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rol()
    {
        $rol = Rol::factory()->create();

        $resp = $this->rolRepo->delete($rol->id);

        $this->assertTrue($resp);
        $this->assertNull(Rol::find($rol->id), 'Rol should not exist in DB');
    }
}
