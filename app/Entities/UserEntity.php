<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserEntity implements Arrayable, JsonSerializable , JWTSubject
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $dateOfBirth;
    private $image;

    public function toArray()
    {
        $array = [];
        $array['id'] = $this->getId();
        $array['name'] = $this->getName();
        $array['email'] = $this->getEmail();
        $array['password'] = $this->getPassword();
        $array['image'] = $this->getImage();
        $array['date_of_birth'] = $this->getDateOfBirth();

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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function getJWTIdentifier()
    {
        return $this->getId();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
