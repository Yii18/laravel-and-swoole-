<?php

namespace App\Blog\Services;


use App\Blog\Repositories\PostToTagRepository;

class PostToTagService
{
    /** @var PostToTagRepository  */
    protected $postToTagRepository;

    /**
     * PostToTagService constructor.
     * @param PostToTagRepository $postToTagRepository
     */
    public function __construct(PostToTagRepository $postToTagRepository)
    {
        $this->postToTagRepository = $postToTagRepository;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $this->postToTagRepository->create($data);
    }

    public function updateAssociation(){

    }

    /**
     * @param $key
     * @param $val
     */
    public function whereDelete($key, $val)
    {
        $this->postToTagRepository->whereDelete($key, $val);
    }
}