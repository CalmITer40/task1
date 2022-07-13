<?php

namespace App\Http\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class HttpNotFoundException extends Exception
{
    public function __construct(string $message = "",
                                int $code = Response::HTTP_NOT_FOUND,
                                ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
