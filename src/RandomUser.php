<?php


namespace Alexandr\RandomUser;

class RandomUser
{
    public $user;

    public function __construct(RandomUserInterface $user)
    {
        $this->user = $user;
    }

    public function create(int $count = 1)
    {
        return  $this->user->generate($count);
    }
}