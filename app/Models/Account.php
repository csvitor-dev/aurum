<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Account extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = [
        'uuid',
        'name',
        'balance',
    ];
}
