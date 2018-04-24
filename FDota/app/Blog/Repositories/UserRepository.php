<?php

namespace App\Blog\Repositories;


use App\User;

class UserRepository
{
    /** @var User 注入 User model */
    protected $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * get all
     * @return mixed
     */
    public function all()
    {
        return $this->user->orderBy('created_at', 'desc')->get();
    }

    public function find($uid)
    {
        return $this->user->where('id', $uid)->first();
    }
}