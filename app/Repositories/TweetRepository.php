<?php

namespace App\Repositories;

use App\Entities\SearchTweetEntity;
use App\Entities\TweetEntity;
use App\Tweet;

class TweetRepository
{
    private $tweet;
    private $userRepository;

    public function __construct(Tweet $tweet, userRepository $userRepository)
    {
        $this->tweet = $tweet;
        $this->userRepository = $userRepository;
    }

    public function store(TweetEntity $tweetEntity)
    {
        $tweet = $this->tweet->create($tweetEntity->toArray());
        $tweetEntity->setId($tweet->id);

        return $tweetEntity;
    }


    public function find(int $tweet_id)
    {
        $tweet = $this->tweet->findOrFail($tweet_id);
        $tweetEntity = new TweetEntity();
        $tweetEntity->setId($tweet->id);
        $tweetEntity->setText($tweet->text);
        $tweetEntity->setUser($this->userRepository->find($tweet->user_id));

        return $tweetEntity;
    }

    protected function getTimeLineTweets(array $ids)
    {
        return $this->tweet->withCount('likes')->whereIn('user_id', $ids)->orderBy('created_at', 'desc')->get();
    }
}
