<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUsersByRoleId()
    {
       $user = User::factory()->create([
           'role_id' => 2
       ]);
       $users = User::factory(10)->create();
       $response = $this->actingAs($user)->post('/api/report', [
        'user_id' => $users[5]->id
       ]);

       $response->assertStatus(200);
    }

    public function testGetAllClientsIfAdmin()
    {
        $user = User::factory()->create([
            'role_id' => 1
        ]);
        $userProjects = UserProject::factory(10)->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)->post('/api/report/clients', [
            'user_id' => $userProjects[0]->id
        ]);

        $response->assertStatus(200);

    }

    public function testClientAuthorizationErrorIfUnauthorized()
    {
        $user = User::factory()->create([
            'role_id' => 2
        ]);
        $userProjects = UserProject::factory(10)->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)->post('/api/report/clients', [
            'user_id' => $userProjects[0]->id
        ]);
        $this->assertTrue($response->getOriginalContent()==='You are not authorized');
    }
}
