<?php


namespace Alexandr\Adapter\RandomUser;

use Alexandr\RandomUser\RandomUserInterface;
use KielD01\RandomUser\RandomUser;

class KielD01RandomUserAdapter implements RandomUserInterface
{
    private $user;
    private $users = [];

    public function __construct(RandomUser $randomuser)
    {
        $this->user = $randomuser;
    }

    public function generate(int $count)
    {
        $users_data = $this->user->setResultsCount($count)->fetch()->getResults()->items;

        foreach ($users_data as $user_data) {
            $user['image'] = $user_data->picture->large;
            $user['first_name'] = $user_data->name->first;
            $user['second_name'] = $user_data->name->last;
            $user['gender'] = $user_data->gender;
            $user['city'] = $user_data->location->city;
            $user['email'] = $user_data->email;
            $user['login'] = $user_data->login->username;
            $user['age'] = $user_data->dob->age;
            $user['phone'] = $user_data->phone;

            $this->users[] = $user;
        }
        return $this->users;
    }
}