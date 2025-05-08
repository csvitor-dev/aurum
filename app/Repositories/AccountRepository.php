<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepository as AccountRepositoryContract;

class AccountRepository implements AccountRepositoryContract
{
    public function create(Account $account): Account
    {
        $account->save();
        return $account->refresh();
    }

    public function findByUuid(string $uuid): ?Account
    {
        $query = Account::query();
        return $query->where('uuid', $uuid)->first();
    }
}
