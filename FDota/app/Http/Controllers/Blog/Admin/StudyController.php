<?php

namespace App\Http\Controllers\blog\admin;

use App\Blog\Services\StudyService;
use App\Blog\Services\StudyTagsService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->studyService->paginate(20);

        return view('blog.admin.study.list', compact('list'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = $this->studyTagsService->all();

        return view('blog.admin.study.add', compact('tags'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->studyService->firstOrCreate(['title' => $request->input('title')], $request->all());

        return redirect(route('blogAdminStudyList'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $row = $this->studyService->find($id);

        $tags = $this->studyTagsService->all();

        return view('blog.admin.study.update', compact('row', 'tags'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, int $id)
    {
        $this->studyService->update($id, $request->all());

        return redirect(route('blogAdminStudyList'));
    }
}
