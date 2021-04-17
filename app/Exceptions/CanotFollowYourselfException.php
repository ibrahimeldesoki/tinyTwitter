<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class CanotFollowYourselfException extends APIExceptions
{
    public function __construct($message = null)
    {
        $message = $message ?? "You can't follow yourself !";
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
