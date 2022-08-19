<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example() {
        $admin = User::factory()->create([
            'status' => 1,
            'is_verified'=>1,
            'role_id' => 1
        ]);

        $project = Project::where('id',1);
        $category = Category::factory()->create([
            'name' => 'test'
        ]);

        $categoryGroup = Category::where('name', 'Test')->first();
        $this->assertNotNull($categoryGroup);

        $response = $this->actingAs($admin)->put('api/category/'.$categoryGroup->id, [
            'name' => 'Luka2'
        ]);
        
        $update = Category::where('name', 'Luka2')->first();
        $this->assertNotNull($update);
    }
}
