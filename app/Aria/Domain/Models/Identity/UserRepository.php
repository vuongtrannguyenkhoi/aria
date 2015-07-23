<?php namespace App\Domain\Models\Identity;

use App\User;

interface UserRepository
{

    /**
     * Add a new User
     *
     * @param User $user
     * @return void
     */
    public function add(User $user);

    /**
     * Update an existing User
     *
     * @param User $user
     * @return void
     */
    public function update(User $user);

    /**
     * Find a user by their id
     *
     * @param Integer $id
     * @return User
     */
    public function userOfId($id);

    /**
     * Find a user by their email address
     *
     * @param $email
     * @return User
     */
    public function userOfEmail($email);
}
