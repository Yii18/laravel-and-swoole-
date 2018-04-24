<?php

namespace App\Http\Controllers\blog\home;

use App\Blog\Services\StudyService;
use App\Blog\Services\StudyTagsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class StudyController extends Controller
{
    /** @var StudyService  */
    protected $studyService;
    /** @var StudyTagsService  */
    protected $studyTagsService;

    /**
     * StudyController constructor.
     * @param StudyService $studyService
     * @param StudyTagsService $studyTagsService
     */
    public function __construct(StudyService $studyService, StudyTagsService $studyTagsService)
    {
        $this->studyService = $studyService;

        $this->studyTagsService = $studyTagsService;
    }

    /**
     * 查看所有收藏的学习资料
     * @return View
     */
    public function index()
    {
        $list = json_encode($this->studyService->get(12));

        $tags = json_encode($this->studyTagsService->all());

        return view('blog.home.study.list', compact('list', 'tags'));
    }

    /**
     * 分页获取数据接口
     * @param $paginate
     */
    public function paginateData($paginate)
    {
        return $this->studyService->paginate($paginate);
    }
}
