<?php

namespace App\Blog\Services;


use App\Blog\Repositories\StudyTagsRepository;

class StudyTagsService
{
    /** @var StudyTagsRepository  */
    protected $studyTagsRepository;

    /**
     * StudyTagsService constructor.
     * @param StudyTagsRepository $studyTagsRepository
     */
    public function __construct(StudyTagsRepository $studyTagsRepository)
    {
        $this->studyTagsRepository = $studyTagsRepository;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->studyTagsRepository->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->studyTagsRepository->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data)
    {
        if (isset($data['_token'])) unset($data['_token']);

        return $this->studyTagsRepository->firstOrCreate($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id,array $data)
    {
        if (isset($data['_token'])) unset($data['_token']);

        return $this->studyTagsRepository->update($id, $data);
    }
}