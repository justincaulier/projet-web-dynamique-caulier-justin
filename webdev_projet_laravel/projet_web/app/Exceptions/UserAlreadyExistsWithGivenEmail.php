<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsWithGivenEmail extends Exception
{
    public function __construct(
        string $message = 'A user with this email already exists. Please login with email/password or Google.',
        int $code = 409,
        ?\Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
