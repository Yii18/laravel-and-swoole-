<?php

namespace App\Blog\Repositories;


use App\Blog\Model\Tag;

class TagRepository
{
    /** @var Tag  */
    protected $tag;

    /**
     * TagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function all()
    {
        return $this->tag->orderBy('created_at', 'desc')->get();
    }

    public function find($tid)
    {
        return $this->tag->where('id', $tid)->first();
    }

    /**
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $where, array $data)
    {
        return $this->tag->firstOrCreate($where, $data);
    }
}