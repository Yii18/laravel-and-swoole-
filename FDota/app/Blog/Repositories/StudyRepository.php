<?php

namespace App\Blog\Repositories;

use App\Blog\Model\Study;

class StudyRepository
{
    /** @var Study 注入 Study model  */
    protected $study;

    /**
     * StudyRepository constructor.
     * @param Study $study
     */
    public function __construct(Study $study)
    {
        $this->study = $study;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->study->select('study.*', 'study_tags.title as tags_title')
            ->join('study_tags', 'study.study_tags_id', 'study_tags.id')
            ->where('study.id', $id)
            ->first();
    }

    /**
     * 获取limit条
     * @param int $limit
     */
    public function get(int $limit)
    {
        return $this->study
            ->select('study.*', 'study_tags.title as tags_title')
            ->join('study_tags', 'study.study_tags_id', 'study_tags.id')
            ->orderBy('study.created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function paginate(int $paginate)
    {
        return $this->study->select('study.*', 'study_tags.title as tags_title')
            ->join('study_tags', 'study.study_tags_id', 'study_tags.id')
            ->orderBy('study.created_at', 'desc')
            ->paginate($paginate);
    }

    /**
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $where, array $data)
    {
        return $this->study->firstOrCreate($where, $data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->study->where('id', $id)->update($data);
    }
}