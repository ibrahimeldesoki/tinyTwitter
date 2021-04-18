<?php

namespace App\Http\Controllers;

use App\Entities\TweetEntity;
use App\Http\Requests\TweetRequest;
use App\Http\Requests\UpdateTweetRequest;
use App\Services\TweetService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    private $tweetService;
    private $userService;

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
        $tweet = $this->tweetService->create($tweetEntity);

        return response()->json(compact('tweet'));
    }

    public function update(UpdateTweetRequest $updateTweetRequest, $id)
    {
        $this->tweetService->find($id);

        $tweetEntity = new TweetEntity();
        $tweetEntity->setId($id);
        $tweetEntity->setText($updateTweetRequest->text);
        $tweetEntity->setUser($this->userService->find(Auth::user()->id));

        return $this->tweetService->update($tweetEntity);
    }

    public function delete($id)
    {
        $tweetEntity = $this->tweetService->find($id);
        $userEntity = $this->userService->find(Auth::user()->id);

        return $this->tweetService->delete($tweetEntity, $userEntity);
    }
}
