<?php

namespace  App\Services;

use App\Entities\TweetEntity;
use App\Entities\UserEntity;
use App\Exceptions\AccessDeniedException;
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

    public function find($id)
    {
        return  $this->tweetRepository->find($id);
    }

    public function update(TweetEntity $tweetEntity)
    {
        $oldTweetEntity = $this->find($tweetEntity->getId());
        if ($oldTweetEntity->getUser()->getId() != $tweetEntity->getUser()->getId()) {
            throw new AccessDeniedException();
        }

        return $this->tweetRepository->update($tweetEntity);
    }

    public function delete(TweetEntity $tweetEntity, UserEntity $userEntity)
    {
        if ($tweetEntity->getUser()->getId() != $userEntity->getId()) {
            throw new AccessDeniedException();
        }
       return $this->tweetRepository->delete($tweetEntity->getId());
    }
}
