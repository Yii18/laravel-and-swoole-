<?php

namespace App\Http\Controllers\blog\admin;

use App\Blog\Services\StudyTagsService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class StudyTagsController extends Controller
{
    /** @var StudyTagsService  */
    protected $studyTagsService;

    public function __construct(StudyTagsService $studyTagsService)
    {
        $this->studyTagsService = $studyTagsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {
        $list = $this->studyTagsService->all();

        return view('blog.admin.studyTags.list', compact('list'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('blog.admin.studyTags.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->studyTagsService->firstOrCreate($request->all());

        return redirect(route('blogAdminStudyTagsCreate'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $row = $this->studyTagsService->find($id);

        return view('blog.admin.studyTags.update', compact('row'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, int $id)
    {
        $this->studyTagsService->update($id, $request->all());

        return redirect(route('blogAdminStudyTagsList'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
