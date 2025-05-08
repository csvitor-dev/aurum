<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\CreateAccountDto;
use App\Exceptions\Internal\ModelNotFoundException;
use App\Http\Resources\Api\AccountResource;
use App\Models\Account;
use App\Repositories\Contracts\AccountRepository;
use App\Services\Contracts\AccountService as AccountServiceContract;

class AccountService implements AccountServiceContract
{
    public function __construct(
        private readonly AccountRepository $repository,
    ) {
    }

    public function create(CreateAccountDto $dto): AccountResource
    {
        $model = $this->repository
            ->create(new Account($dto->toArray()));

        return new AccountResource($model);
    }

    public function getByUuid(string $uuid): AccountResource
    {
        $model = $this->repository->findByUuid($uuid);

        if (null !== $model) {
            throw new ModelNotFoundException(Account::class);
        }
        return new AccountResource($model);
    }
}
