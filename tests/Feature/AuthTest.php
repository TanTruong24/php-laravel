<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Truong The Tan',
            'email' => 'the.tan24@gmail.com',
            'password' => 'phpdeveloper',
            'password_confirmation' => 'phpdeveloper',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'the.tan24@gmail.com']);
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'the.tan24@gmail.com',
            'password' => bcrypt('phpdeveloper'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'the.tan24@gmail.com',
            'password' => 'phpdeveloper',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    /** @test */
    public function a_user_can_logout()
    {
        $user = User::factory()->create();

        $token = $user->createToken('auth-token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->postJson('/api/logout');

        $response->assertStatus(200);
    }
}

