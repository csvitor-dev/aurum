<?php

declare(strict_types=1);

namespace App\Exceptions\Constraints;

use LogicException;

class CurrencyInvalidException extends LogicException
{
    public function __construct()
    {
        parent::__construct("value provided was invalid");
    }
}
