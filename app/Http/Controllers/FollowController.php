<?php

namespace App\Http\Controllers;

use App\Entities\FollowEntity;
use App\Http\Requests\FollowRequest;
use App\Services\FollowService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $followService;
    private $userService;

    public function __construct(FollowService $followService, UserService $userService)
    {
        $this->followService = $followService;
        $this->userService = $userService;
    }

    public function follow(FollowRequest $followRequest)
    {
        $followEntity = new FollowEntity();
        // Auth::user()->id
        $followEntity->setFollowerEntity($this->userService->find(1));
        $followEntity->setFollowingEntity($this->userService->find($followRequest->following_user_id));
        return $this->followService->follow($followEntity);
    }
}
