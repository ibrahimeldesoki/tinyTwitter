<?php

namespace  App\Services;

use App\Entities\TweetEntity;
use App\Http\Requests\UpdateTweetRequest;
use App\Repositories\TweetRepository;
use Exception;

class TweetService
{
    private $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function create(TweetEntity $tweetEntity)
    {
        return $this->tweetRepository->store($tweetEntity);
    }

    public function find($id)
    {
        $foundTweet = $this->tweetRepository->find($id);
        if ($foundTweet ==false) {
            throw new Exception('we can not find this tweet');
        }
        return $foundTweet;
    }
    public function update(TweetEntity $tweetEntity)
    {
        $this->find($tweetEntity->getId());
        return $this->tweetRepository->update($tweetEntity);
    }
}
