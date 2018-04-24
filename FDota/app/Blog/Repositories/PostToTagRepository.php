<?php

namespace App\Blog\Repositories;


use App\Blog\Model\PostToTag;

class PostToTagRepository
{
    /** @var PostToTag  */
    protected $postTotag;

    /**
     * PostToTagRepository constructor.
     * @param PostToTag $postToTag
     */
    public function __construct(PostToTag $postToTag)
    {
        $this->postTotag = $postToTag;
    }

    /**
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return $this->postTotag->create($data);
    }

    /**
     * @param $key
     * @param $val
     * @return mixed
     */
    public function whereDelete($key, $val)
    {
        return $this->postTotag->where($key, $val)->delete();
    }
}