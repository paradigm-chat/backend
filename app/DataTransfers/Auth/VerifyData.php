<?php

namespace App\DataTransfers\Auth;

use Spatie\LaravelData\Data;

class VerifyData extends Data
{
    public function __construct(
        public string $phone,
        public string $code,
    )
    {

    }
}
