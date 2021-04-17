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


    public function find(int $tweet_id)
    {
        $tweet = $this->tweet->findOrFail($tweet_id);
        $tweetEntity = new TweetEntity();
        $tweetEntity->setId($tweet->id);
        $tweetEntity->setText($tweet->text);
        $tweetEntity->setUser($this->userRepository->find($tweet->user_id));

        return $tweetEntity;
    }

    public function update(TweetEntity $tweetEntity)
    {
        $tweet =$this->tweet->find($tweetEntity->getId());
        $tweet->update(['text' =>$tweetEntity->getText() ]);

        return $tweetEntity;
    }
    public function delete($id)
    {
        $this->tweet->find($id)->delete();
        return response()->json(['success' => 'true', 'message' => 'Tweet Deleted Sucssfully'],200);
    }
}
