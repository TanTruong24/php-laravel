<?php

namespace Tests\Feature;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_store()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth-token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->postJson('/api/stores', [
                             'name' => 'Test Store',
                             'description' => 'Test description',
                         ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('stores', ['name' => 'Test Store']);
    }

    /** @test */
    public function a_user_can_list_their_stores()
    {
        $user = User::factory()->create();
        $stores = Store::factory()->count(5)->create(['user_id' => $user->id]);

        $token = $user->createToken('auth-token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->getJson('/api/stores');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function a_user_can_update_a_store()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create(['user_id' => $user->id]);

        $token = $user->createToken('auth-token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->putJson("/api/stores/{$store->id}", [
                             'name' => 'Updated Store Name',
                             'description' => 'Updated description',
                         ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('stores', ['name' => 'Updated Store Name']);
    }

    /** @test */
    public function a_user_can_delete_a_store()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create(['user_id' => $user->id]);

        $token = $user->createToken('auth-token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->deleteJson("/api/stores/{$store->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('stores', ['id' => $store->id]);
    }
}

