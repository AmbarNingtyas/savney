<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class TransactionTest extends TestCase
{
    public function test_user_can_create_transaction()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/transactions', [
            'amount' => 50000,
            'description' => 'Gaji',
            'category' => 'Pekerjaan',
            'type' => 'income',
            'date' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['description' => 'Gaji']);
    }

    public function test_user_can_list_transactions()
    {
        Sanctum::actingAs($user = User::factory()->create());

        $user->transactions()->create([
            'amount' => 25000,
            'description' => 'Makan',
            'category' => 'Makanan',
            'type' => 'expense',
            'date' => now(),
        ]);

        $response = $this->getJson('/api/transactions');

        $response->assertStatus(200)
                 ->assertJsonStructure([[
                     'id', 'amount', 'description', 'category', 'type', 'date'
                 ]]);
    }
}
