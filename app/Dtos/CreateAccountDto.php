<?php

declare(strict_types=1);

namespace App\Dtos;

use Illuminate\Http\Request;

readonly class CreateAccountDto
{
    private function __construct(
        public string $name,
        public float $balance,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'balance' => $this->balance,
        ];
    }

    public static function from(Request $request): static
    {
        return new static(
            name: $request->input('name'),
            balance: $request->input('balance'),
        );
    }
}
