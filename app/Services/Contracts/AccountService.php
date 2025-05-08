<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Dtos\CreateAccountDto;
use App\Http\Resources\Api\AccountResource;

interface AccountService
{
    public function create(CreateAccountDto $dto): AccountResource;

    public function getByUuid(string $uuid): ?AccountResource;
}
