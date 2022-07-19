<?php namespace Tests\Repositories;

use App\Models\Titulo;
use App\Repositories\TituloRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TituloRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TituloRepository
     */
    protected $tituloRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tituloRepo = \App::make(TituloRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_titulo()
    {
        $titulo = Titulo::factory()->make()->toArray();

        $createdTitulo = $this->tituloRepo->create($titulo);

        $createdTitulo = $createdTitulo->toArray();
        $this->assertArrayHasKey('id', $createdTitulo);
        $this->assertNotNull($createdTitulo['id'], 'Created Titulo must have id specified');
        $this->assertNotNull(Titulo::find($createdTitulo['id']), 'Titulo with given id must be in DB');
        $this->assertModelData($titulo, $createdTitulo);
    }

    /**
     * @test read
     */
    public function test_read_titulo()
    {
        $titulo = Titulo::factory()->create();

        $dbTitulo = $this->tituloRepo->find($titulo->id);

        $dbTitulo = $dbTitulo->toArray();
        $this->assertModelData($titulo->toArray(), $dbTitulo);
    }

    /**
     * @test update
     */
    public function test_update_titulo()
    {
        $titulo = Titulo::factory()->create();
        $fakeTitulo = Titulo::factory()->make()->toArray();

        $updatedTitulo = $this->tituloRepo->update($fakeTitulo, $titulo->id);

        $this->assertModelData($fakeTitulo, $updatedTitulo->toArray());
        $dbTitulo = $this->tituloRepo->find($titulo->id);
        $this->assertModelData($fakeTitulo, $dbTitulo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_titulo()
    {
        $titulo = Titulo::factory()->create();

        $resp = $this->tituloRepo->delete($titulo->id);

        $this->assertTrue($resp);
        $this->assertNull(Titulo::find($titulo->id), 'Titulo should not exist in DB');
    }
}
