<?php

namespace App\Blog\Services;


use App\Blog\Repositories\StudyRepository;

class StudyService
{
    /** @var StudyRepository  */
    protected $studyRepository;

    /**
     * StudyService constructor.
     * @param StudyRepository $studyRepository
     */
    public function __construct(StudyRepository $studyRepository)
    {
        $this->studyRepository = $studyRepository;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->studyRepository->find($id);
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function get($limit)
    {
        return $this->studyRepository->get($limit);
    }

    /**
     * @param $paginate
     */
    public function paginate($paginate)
    {
        return $this->studyRepository->paginate($paginate);
    }


    /**
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $where, array $data)
    {
        if (isset($data['_token'])) unset($data['_token']);

        if (isset($data['title'])) unset($data['title']);

        return $this->studyRepository->firstOrCreate($where, $data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        if (isset($data['_token'])) unset($data['_token']);

        return $this->studyRepository->update($id, $data);
    }
}