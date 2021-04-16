<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class TweetEntity implements Arrayable, JsonSerializable
{
    private $id;
    private $text;
    private $user;

    public function toArray()
    {
        $array = [];
        $array['id'] = $this->getId();
        $array['text'] = $this->getText();
        $array['user'] = $this->getUser();

        return $array;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setUser(UserEntity $userEntity)
    {
        $this->user = $userEntity;
    }

    public function getUser()
    {
        return $this->user;
    }
}
