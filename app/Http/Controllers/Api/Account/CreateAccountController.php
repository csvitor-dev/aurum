<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Account;

use App\Dtos\CreateAccountDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateAccountRequest;
use App\Services\Contracts\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class CreateAccountController extends Controller
{
    public function __construct(
        private readonly AccountService $service,
    ) {
    }

    public function __invoke(CreateAccountRequest $request): JsonResponse
    {
        $resource = $this->service
            ->create(CreateAccountDto::from($request));

        return response()
            ->json($resource, Response::HTTP_CREATED);
    }
}
