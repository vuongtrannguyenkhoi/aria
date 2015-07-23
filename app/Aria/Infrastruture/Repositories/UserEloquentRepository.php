<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Identity\UserRepository;
use App\User;

/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/21/2015
 * Time: 3:37 PM
 */
class UserEloquentRepository implements UserRepository
{

    private $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {

        $this->model = $model;
    }
    
    /**
     * Add a new User
     *
     * @param User $user
     * @return void
     */
    public function add(User $user)
    {
       $user->save();
    }

    /**
     * Update an existing User
     *
     * @param User $user
     * @return void
     */
    public function update(User $user)
    {
        $user->save();
    }

    /**
     * Find a user by their id
     *
     * @param Integer $id
     * @return User
     */
    public function userOfId($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find a user by their email address
     *
     * @param $email
     * @return User
     */
    public function userOfEmail($email)
    {
        return $this->model->whereEmail($email);
    }
}