<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class AccessDeniedException extends APIExceptions
{
    public function __construct($message = null)
    {
        $message = $message ?? 'Access Denied';
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
