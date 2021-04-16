<?php

namespace App\Http\Controllers;

use App\Entities\TweetEntity;
use App\Http\Requests\TweetRequest;
use App\Services\TweetService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    private $tweetService;
    public function __construct(TweetService $tweetService, UserService $userService)
    {
        $this->tweetService = $tweetService;
        $this->userService = $userService;
    }
    public function store(TweetRequest $tweetRequest)
    {
        $tweetEntity = new  TweetEntity();
        $tweetEntity->setUser($this->userService->find(Auth::user()->id));
        $tweetEntity->setText($tweetRequest->text);
        $this->tweetService->create($tweetEntity);
    }
}
