<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class FollowedExistException extends APIExceptions
{
    public function __construct($message = null)
    {
        $message = $message ?? "You followed this user before !";
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
