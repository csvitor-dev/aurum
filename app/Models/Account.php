<?php

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\Constraints\CurrencyInvalidException;
use App\Observers\UuidGeneratorObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(
    UuidGeneratorObserver::class,
)]
final class Account extends Model
{
    use HasFactory;

    private float $balance = 0.0;

    /**
     * Register all movements from account.
     *
     * @var array<int,float>
     */
    private array $statement = [];

    protected $table = 'account';

    protected $fillable = [
        'uuid',
        'name',
        'balance',
    ];

    protected $casts = [
        'balance' => 'float',
    ];

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getStatement(): array
    {
        return $this->statement;
    }

    /**
     * @throws \App\Exceptions\Constraints\CurrencyInvalidException
     */
    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new CurrencyInvalidException();
        }
        $this->balance += $amount;

        $this->statement[] = $amount;
    }

    /**
     * @throws \App\Exceptions\Constraints\CurrencyInvalidException
     */
    public function withdraw(float $amount): void
    {
        if ($amount <= 0 || $amount > $this->balance) {
            throw new CurrencyInvalidException();
        }
        $this->balance -= $amount;
        $this->statement[] = -1 * $amount;
    }
}
