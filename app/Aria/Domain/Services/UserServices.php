<?php

namespace App\Domain\Services;
use App\Domain\Models\Identity\UserRepository;
use App\User;
use Assert\Assertion;

/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/21/2015
 * Time: 3:53 PM
 */
class UserServices
{

    /**
     * @var UserRepository $users
     */
    private $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return User
     */
    public function register($name, $email, $password)
    {

        Assertion::string($name);
        Assertion::email($email);
        $password = bcrypt($password);

        $user = User::register($name, $email, $password);

        $this->users->add($user);

        return $user;
    }

    private function checkUniqueEmail($email){
        return true;
    }
}