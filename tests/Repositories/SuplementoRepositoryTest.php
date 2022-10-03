<?php namespace Tests\Repositories;

use App\Models\Suplemento;
use App\Repositories\SuplementoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SuplementoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SuplementoRepository
     */
    protected $suplementoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->suplementoRepo = \App::make(SuplementoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_suplemento()
    {
        $suplemento = Suplemento::factory()->make()->toArray();

        $createdSuplemento = $this->suplementoRepo->create($suplemento);

        $createdSuplemento = $createdSuplemento->toArray();
        $this->assertArrayHasKey('id', $createdSuplemento);
        $this->assertNotNull($createdSuplemento['id'], 'Created Suplemento must have id specified');
        $this->assertNotNull(Suplemento::find($createdSuplemento['id']), 'Suplemento with given id must be in DB');
        $this->assertModelData($suplemento, $createdSuplemento);
    }

    /**
     * @test read
     */
    public function test_read_suplemento()
    {
        $suplemento = Suplemento::factory()->create();

        $dbSuplemento = $this->suplementoRepo->find($suplemento->id);

        $dbSuplemento = $dbSuplemento->toArray();
        $this->assertModelData($suplemento->toArray(), $dbSuplemento);
    }

    /**
     * @test update
     */
    public function test_update_suplemento()
    {
        $suplemento = Suplemento::factory()->create();
        $fakeSuplemento = Suplemento::factory()->make()->toArray();

        $updatedSuplemento = $this->suplementoRepo->update($fakeSuplemento, $suplemento->id);

        $this->assertModelData($fakeSuplemento, $updatedSuplemento->toArray());
        $dbSuplemento = $this->suplementoRepo->find($suplemento->id);
        $this->assertModelData($fakeSuplemento, $dbSuplemento->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_suplemento()
    {
        $suplemento = Suplemento::factory()->create();

        $resp = $this->suplementoRepo->delete($suplemento->id);

        $this->assertTrue($resp);
        $this->assertNull(Suplemento::find($suplemento->id), 'Suplemento should not exist in DB');
    }
}
