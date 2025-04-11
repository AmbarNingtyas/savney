<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class InvestmentTest extends TestCase
{
    public function test_user_can_create_investment()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/investments', [
            'current_balance' => 100000,
            'monthly_interest' => 5,
            'target_amount' => 200000,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['monthly_interest' => 5]);
    }

    public function test_user_can_predict_investment()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/investments/predict', [
            'current_balance' => 100000,
            'monthly_interest' => 5,
            'target_amount' => 200000,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['months_needed', 'monthly_profit']);
    }
}
