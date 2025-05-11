<?php

declare(strict_types=1);

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UuidGeneratorObserver
{
    public function creating(Model $self): void
    {
        if (null === $self->uuid) {
            $uuid = Str::uuid()->toString();
            $self->setAttribute('uuid', $uuid);
        }
    }
}
