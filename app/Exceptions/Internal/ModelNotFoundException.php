<?php

declare(strict_types=1);

namespace App\Exceptions\Internal;

use LogicException;

class ModelNotFoundException extends LogicException
{
    public function __construct(string $model)
    {
        parent::__construct(message: "$model was not found.");
    }
}
