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
        $attributes = [];
        $attributes['text'] = $tweetEntity->getText();
        $attributes['user_id'] = $tweetEntity->getUser()->getId();
        $tweet = $this->tweet->create($attributes);
        $tweetEntity->setId($tweet->id);

        return $tweetEntity;
    }


    public function find(int $id)
    {
        return  $this->tweet->where('id', $id)->exists();
    }

    public function update(TweetEntity $tweetEntity)
    {
        $tweet =$this->tweet->find($tweetEntity->getId());
        $tweet->update(['text' =>$tweetEntity->getText() ]);
        $tweetEntity->setText($tweet->text);
        return $tweetEntity;
    }
}
