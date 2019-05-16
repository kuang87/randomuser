<?php


namespace Alexandr\Adapter\RandomUser;

use Alexandr\RandomUser\RandomUserInterface;

class RandomMeUserAdapter implements RandomUserInterface
{
    private $json;
    private $url;
    private $users = [];

    public function __construct()
    {
        $url = 'https://randomuser.me/api';
        $this->url = $url;
    }

    public function generate(int $count)
    {
        for ($i = 0; $i < $count; $i++){
            try {
                $json = @file_get_contents($this->url);
                if ($json === false) {
                    throw new Exception("Ошибка чтения!!!");
                }
            } catch (Exception $e) {
                echo 'ОШИБКА: ' . $e->getMessage();
            }
            $this->json = $json ?? '';

            $user_data = json_decode($this->json, true)['results'][0];
            $user['image'] = $user_data['picture']['large'];
            $user['first_name'] = $user_data['name']['first'];
            $user['second_name'] = $user_data['name']['last'];
            $user['gender'] = $user_data['gender'];
            $user['city'] = $user_data['location']['city'];
            $user['email'] = $user_data['email'];
            $user['login'] = $user_data['login']['username'];
            $user['age'] = $user_data['dob']['age'];
            $user['phone'] = $user_data['phone'];

            $this->users[] = $user;
        }
        return $this->users;
    }
}