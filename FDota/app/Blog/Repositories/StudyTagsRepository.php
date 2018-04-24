<?php

namespace App\Blog\Repositories;


use App\Blog\Model\StudyTags;

class StudyTagsRepository
{
    /** @var StudyTags 注入 StudyTags model  */
    protected $studyTags;

    /**
     * StudyTagsRepository constructor.
     * @param StudyTags $studyTags
     */
    public function __construct(StudyTags $studyTags)
    {
        $this->studyTags = $studyTags;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->studyTags->where('id', $id)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->studyTags->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data)
    {
        return $this->studyTags->firstOrCreate($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->studyTags->where('id', $id)->update($data);
    }
}