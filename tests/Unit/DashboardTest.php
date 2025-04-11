<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class DashboardTest extends TestCase
{
    public function test_dashboard_summary_returns_data()
    {
        Sanctum::actingAs($user = User::factory()->create());

        $user->transactions()->create([
            'amount' => 100000,
            'description' => 'Gaji',
            'type' => 'income',
            'category' => 'Kerja',
            'date' => now(),
        ]);

        $user->transactions()->create([
            'amount' => 20000,
            'description' => 'Makan siang',
            'type' => 'expense',
            'category' => 'Makanan',
            'date' => now(),
        ]);

        $response = $this->getJson('/api/dashboard');

        $response->assertStatus(200)
                 ->assertJson([
                     'income' => 100000,
                     'expense' => 20000,
                     'balance' => 80000,
                 ]);
    }
}
