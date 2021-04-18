<?php

namespace App\Utils;

use App\Services\UserService;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Http\Parser\Parser;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Manager;

class JWTAppAuth extends JWTAuth
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService, Manager $manager, Auth $auth, Parser $parser)
    {
        $this->userService = $userService;
        parent::__construct($manager, $auth, $parser);
    }

    public function user()
    {
        return $this->userService->find($this->auth->user()->id);
    }
}
