<?php

namespace App\DataTransfers\Auth;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public string $phone,
    )
    {
    }
}
