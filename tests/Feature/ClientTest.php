<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Country;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Database\Factories\ClientFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    public $admin;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testGetPaginatedClients()
    {
        $response = $this->actingAs(User::factory()->create())->get('/api/client');
        $response->assertStatus(200);
    }

    public function testGetClientsAlphabet()
    {
        Client::factory(5)->create();
        $response = $this->actingAs(User::factory()->create())->get('/api/client/alphabet')->getOriginalContent();

        $letters = DB::table('clients')
                ->selectRaw("SUBSTRING(name, 1,1) AS letter")
                ->groupBy("letter")->get();

        $lettersCollect = collect($letters)->map(function($letter) {
            return $letter->letter;
        });

        $this->assertEquals($lettersCollect, $response);

    }

    public function testStoreClient() {
        $payload = Client::factory()->create([
            'name' => 'Klijent 1'
        ]);
        $this->actingAs(User::factory()->create())->post('/api/client', [$payload]);
        $this->assertDatabaseHas('clients', [
            'name'=> 'Klijent 1'
        ]);
    }

    public function testUpdateClient() {
        $payload = Client::factory()->create([
            'name' => 'Klijent 1',
            'country_id' => Country::factory()
        ]);
        $response = $this->actingAs(User::factory()->create())->put("/api/client/$payload->id", [
            'name' => 'Klijent 1 updated',
            'country_id' => Country::factory()->create()->id
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('clients',[
            'name' => 'Klijent 1 updated'
        ]);
    }

}
