<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AutoCutTest extends TestCase
{
    public function test_user_can_create_auto_cut()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/autoCuts', [
            'amount' => 10000,
            'description' => 'Tabungan bulanan',
            'category' => 'Tabungan',
            'deduction_date' => now()->addMonth()->format('Y-m-d'),
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['description' => 'Tabungan bulanan']);
    }

    public function test_user_can_list_auto_cuts()
    {
        Sanctum::actingAs($user = User::factory()->create());

        $user->autoCuts()->create([
            'amount' => 15000,
            'description' => 'Netflix',
            'category' => 'Langganan',
            'deduction_date' => now()->addDays(5),
        ]);

        $response = $this->getJson('/api/autoCuts');

        $response->assertStatus(200)
                 ->assertJsonStructure([[
                     'id', 'amount', 'description', 'category', 'deduction_date'
                 ]]);
    }
}
