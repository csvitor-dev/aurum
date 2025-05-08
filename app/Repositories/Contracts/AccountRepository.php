<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Account;

interface AccountRepository
{
    public function create(Account $account): Account;

    public function findByUuid(string $uuid): ?Account;
}
