<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Account;

use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetByIdControllerTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_should_retrieve_an_account_on_success(): void
    {
        $uuid = fake()->uuid();
        Account::factory()->create([
            'uuid' => $uuid,
        ]);

        $response = $this->getJson("/api/account/{$uuid}");

        $response->assertOk();
        $response->assertJson(function (AssertableJson $json): AssertableJson {
            return $json
                ->has('id')
                ->has('name')
                ->has('balance')
                ->etc();
        });
    }
}
