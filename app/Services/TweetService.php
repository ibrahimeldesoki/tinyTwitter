<?php

namespace  App\Services;

use App\Entities\TweetEntity;
use App\Exceptions\ForbiddenUpdateTweetException;
use App\Http\Requests\UpdateTweetRequest;
use App\Repositories\TweetRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

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
        return $this->tweetRepository->find($id);
    }
    public function update(TweetEntity $tweetEntity)
    {

        $oldTweetEntity = $this->find($tweetEntity->getId());
        if($oldTweetEntity->getUser()->getId() != $tweetEntity->getUser()->getId())
        {
            throw new ForbiddenUpdateTweetException;
        }
        return $this->tweetRepository->update($tweetEntity);
    }
}
