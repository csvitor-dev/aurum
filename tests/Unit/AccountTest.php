<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\Constraints\CurrencyInvalidException;
use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_should_create_an_account_with_valid_fields_on_success(): void
    {
        $name = fake()->word();
        $account = new Account([
            'name' => $name,
        ]);

        $this->assertSame($name, $account->name);
        $this->assertSame(0.0, $account->getBalance());
        $this->assertEmpty($account->getStatement());
    }

    #[Test]
    public function it_should_make_deposit_on_fail(): void
    {   
        /** @var Account $account */
        $account = Account::factory()->create();
        $amount = -1 * fake()->randomFloat(nbMaxDecimals: 2, max: 9999.99);

        $this->expectException(CurrencyInvalidException::class);
        $account->deposit($amount);
    }

    #[Test]
    public function it_should_make_deposit_on_success(): void
    {
        /** @var Account $account */
        $account = Account::factory()->create();
        $amount = fake()->randomFloat(nbMaxDecimals: 2, max: 9999.99);

        $account->deposit($amount);

        $this->assertSame($amount, $account->getBalance());
        $this->assertCount(1, $account->getStatement());
        $this->assertContains($amount, $account->getStatement());
    }

    #[Test]
    public function it_should_make_withdraw_on_fail(): void
    {   
        /** @var Account $account */
        $account = Account::factory()->create();
        $amount = -1 * fake()->randomFloat(nbMaxDecimals: 2);

        $this->expectException(CurrencyInvalidException::class);
        $account->withdraw($amount);
    }

    #[Test]
    public function it_should_make_withdraw_on_success(): void
    {
        /** @var Account $account */
        $account = Account::factory()->create();
        $amount = fake()->randomFloat(nbMaxDecimals: 2, max: 499.99);

        $account->deposit(500.00);
        $account->withdraw($amount);

        $this->assertSame(500.00 - $amount,
            $account->getBalance());
        $this->assertCount(2, $account->getStatement());
        $this->assertContains(500.00, $account->getStatement());
        $this->assertContains(-1 * $amount, $account->getStatement());
    }
}
