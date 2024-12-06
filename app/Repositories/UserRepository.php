<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Summary of User
     * @var User
     */
    protected $user;

    /**
     * Summary of __construct
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Summary of store
     *
     * @param  array<string, mixed>  $inputs
     *
     * @return User
     */
    public function store(array $inputs)
    {
        $user = new User();
        return $this->save($user, $inputs);
    }

    /**
     * Summary of save
     *
     * @param  array<string, mixed>  $inputs
     *
     * @return User
     */
    private function save(User $user, array $inputs)
    {
        if (!$user->exists) {
            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->password = bcrypt($inputs['password']);
            $user->save();
            return $user;
        } else{
            Throw new \Exception('User already exists.');
        }
    }
}
