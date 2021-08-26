<?php

namespace  App\Services;

use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;

class ReportService
{
    private $userRepository;
    private $tweetRepository;

    public function __construct(UserRepository $userRepository, TweetRepository $tweetRepository)
    {
        $this->userRepository = $userRepository;
        $this->tweetRepository = $tweetRepository;
    }

    public function report()
    {
        $users = $this->userRepository->all();
        $tweetsCount = $this->tweetRepository->count();

        $users->map(function ($user) use ($tweetsCount) {
            $avg = 0;
            if ($tweetsCount > 0) {
                $avg = ($user->tweets_count / $tweetsCount) * 100;
            }

            return $user->avg = $avg;
        });

        return $users;
    }
}
