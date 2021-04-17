<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ForbiddenUpdateTweetException extends APIExceptions
{
    public function __construct($message = null)
    {
        $message = $message ?? "You can't update this tweet !";
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
