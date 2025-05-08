<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Services\Contracts\AccountService;
use Illuminate\Http\JsonResponse;

final class GetAccountByIdController extends Controller
{
    public function __construct(
        private readonly AccountService $service,
    ) {
    }

    public function __invoke(string $uuid): JsonResponse
    {
        $resource = $this->service->getByUuid($uuid);

        return response()
            ->json($resource);
    }
}
