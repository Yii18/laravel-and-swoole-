<?php

namespace App\Blog\Services;


use App\Blog\Repositories\TagRepository;

class TagService
{
    /** @var TagRepository  */
    protected $tagRepository;

    /**
     * TagService constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * 获取全部标签
     * @return mixed
     */
    public function all()
    {
        return $this->tagRepository->all();
    }

    public function find($tid)
    {
        return $this->tagRepository->find($tid);
    }

    /**
     * 获取指定标签下的所有帖子
     * @param $tid
     * @return mixed
     */
    public function showTagPostList($tid)
    {
        return $this->tagRepository
            ->find($tid)
            ->posts()
            ->select('posts.id', 'posts.user_id', 'posts.username', 'posts.title', 'posts.created_at')
            ->get();
    }

    /**
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $where, array $data)
    {
        return $this->tagRepository->firstOrCreate($where, $data);
    }
}