<?php

namespace App\Http\Controllers\blog\admin;

use App\Blog\Services\PostsService;
use App\Blog\Services\PostToTagService;
use App\Blog\Services\TagService;
use App\Post;
use App\PostToTag;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /** @var PostsService  */
    protected $postsService;

    /** @var TagService  */
    protected $tagService;

    /** @var PostToTagService  */
    protected $postToTagService;

    /**
     * ArticleController constructor.
     * @param PostsService $postsService
     * @param TagService $tagService
     * @param PostToTagService $postToTagService
     */
    public function __construct(PostsService $postsService, TagService $tagService, PostToTagService $postToTagService)
    {
        $this->postsService = $postsService;

        $this->tagService = $tagService;

        $this->postToTagService = $postToTagService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->postsService->allPostsAndTagsString();

        return view('blog.admin.article.list', compact('list'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $art = $this->postsService->findPostAndTagString($id);

        return view('blog.admin.article.update', compact('art'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if ( $id = $this->postsService->update($id, $request->all()) )
        {
            $this->postToTagService->whereDelete('post_id', $id);

            foreach ($request->input('tag') as $val)
            {
                $tagId = $this->tagService->firstOrCreate(
                    ['name' => $val],
                    ['user_id' => Auth::User()->id]
                )->id;

                $this->postToTagService->create([
                    'user_id' => Auth::User()->id,
                    'post_id' => $id,
                    'tag_id' => $tagId
                ]);
            }
        }

        return redirect(route('blogAdminArticleList'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('blog.admin.article.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($id = $this->postsService->create($request->all())->id)
        {
            foreach ($request->input('tag') as $tag)
            {
                $tag_id = $this->tagService->firstOrCreate(
                    ['name' => $tag],
                    ['user_id' => Auth::user()->id]
                )->id;

                $this->postToTagService->create(
                    [
                        'user_id' => Auth::user()->id,
                        'post_id' => $id,
                        'tag_id' => $tag_id
                    ]
                );
            }

        }

        return 0;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->postsService->delete($id);

        return redirect(route('blogAdminArticleList'));
    }
}
