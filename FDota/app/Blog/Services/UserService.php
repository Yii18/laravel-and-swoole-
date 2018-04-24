<?php

namespace App\Blog\Services;


use App\Blog\Repositories\UserRepository;

class UserService
{
    /** @var UserRepository  */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * get all
     * @return mixed
     */
    public function all()
    {
        $data = $this->userRepository->all();

        foreach ($data as $key => $val) {
            $data[$key]->avatar = $val->avatar ? $val->avatar : asset('images/xxx.jpg');            $data[$key]->email = $val->email ? $val->email : asset('images/xxx.jpg');
            $data[$key]->email = $val->email ? $val->email : "NULL";
            $data[$key]->username = $val->username ? $val->username : "NULL";
            $data[$key]->steamid = $val->steamid ? $val->steamid : "NULL";
            $data[$key]->qq_id = $val->qq_id ? $val->qq_id : "NULL";
        }

        return $data;
    }

    public function find($uid)
    {
        return $this->userRepository->find($uid);
    }
}