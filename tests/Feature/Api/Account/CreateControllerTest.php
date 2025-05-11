<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Account;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_should_create_an_account_on_success(): void
    {
        $request = [
            'name' => fake()->word(),
            'balance' => fake()->randomFloat(nbMaxDecimals: 2, max: 9999.99),
        ];

        $response = $this->postJson('/api/account', $request);

        $response->assertCreated();
        $response->assertJson(function (AssertableJson $json) use ($request): AssertableJson {
            return $json
                ->has('id')
                ->where('name', $request['name'])
                ->where('balance', $request['balance'])
                ->etc();
        });
        $this->assertDatabaseCount('account', 1);
    }
}
