<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_register()
    {
        $this->withoutExceptionHandling();

        $payload = User::factory()->raw(['password' => 'password']);


        $response = $this->post('api/sanctum/token/register', $payload)->assertStatus(Response::HTTP_OK);

        $data = $response->json();

        $this->assertArrayHasKey('token', $data);
        $this->assertNotEmpty($data['token']);



    }

    public function test_a_user_can_login()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['password' => bcrypt('password')]);

        $payload = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->post('api/sanctum/token', $payload)->assertStatus(Response::HTTP_OK);
        // Retrieve the JSON response as an array
        $data = $response->json();

        $this->assertArrayHasKey('token', $data);
        $this->assertNotEmpty($data['token']);

    }
}
