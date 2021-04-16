<?php

namespace  App\Services;

use App\Entities\TweetEntity;
use App\Repositories\TweetRepository;

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

    public function find($tweet_id)
    {
        return $this->tweetRepository->find($tweet_id);
    }
}
