<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class ApiTest extends TestCase
{
    protected $user;
    /**
     * Setup user.
     *
     * @return void
     */
    public function setUp() :void {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->user->id = 1;
    }

    /**
     * Test 200 response for companies.
     *
     * @return void
     */
    public function test_Companies_Response_200()
    {
        $response = $this->actingAs($this->user, 'api')
        ->get('/api/companies');
        $response->assertStatus(200);
    }

    /**
     * Test JSON response for companies.
     *
     * @return void
     */
    public function test_Companies_JSON() {
        $response = $this->actingAs($this->user, 'api')
        ->json('GET', '/api/companies');
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'companies' => [[
                    'desc' => 'sdasd',
                    'id' => 95,
                    'name' => 'cc',
                    'tags' => '{sasd,dgeg}'
                ]]
            ]);
    }
}
