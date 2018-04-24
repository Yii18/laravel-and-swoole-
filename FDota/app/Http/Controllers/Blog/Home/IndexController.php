<?php

namespace App\Http\Controllers\Blog\Home;

use App\Blog\Services\PostsCommentService;
use App\Blog\Services\PostsService;
use App\Blog\Services\TagService;
use App\Blog\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    /** @var PostsService  */
    protected $postsService;

    /** @var PostsCommentService  */
    protected $postsCommentService;

    /** @var TagService  */
    protected $tagService;

    /** @var  userService */
    protected $userService;

    /**
     * IndexController constructor.
     * @param PostsService $postsService
     * @param PostsCommentService $postsCommentService
     */
    public function __construct(
        PostsService $postsService,
        PostsCommentService $postsCommentService,
        TagService $tagService,
        UserService $userService
    )
    {
        $this->postsService = $postsService;

        $this->postsCommentService = $postsCommentService;

        $this->tagService = $tagService;

        $this->userService = $userService;
    }

    public function index()
    {
        return view('blog.main');
    }

    public function getAuthUserInfo()
    {
        if (Auth::check()) {
            return Auth::user();
        }
        return [];
    }

    /**
     * 查看所有帖子
     * @return View
     */
    public function list()
    {
        $list = $this->postsService->all();

        return compact('list');
    }

    public function rside()
    {
        // $tags = $this->tagService->all();

        $hots = $this->postsService->getHotPosts(5);

        return compact('hots');
    }

    /**
     * 获取用户下的帖子列表
     * @param $uid
     * @return array
     */
    public function showUserPostList($uid)
    {
        $list = $this->postsService->findUserPostList($uid);

        $user = $this->userService->find($uid);

        return compact('list', 'user');
    }

    public function showTagPostList($tid)
    {
        $list = $this->tagService->showTagPostList($tid);

        $tag = $this->tagService->find($tid);

        return compact('list', 'tag');
    }

    /**
     * 查看一篇帖子
     * @param $pid
     * @return View
     */
    public function show($pid)
    {
        $this->postsService->whetherToReadThePost($pid);

        $post = $this->postsService->find($pid);

        return compact('post');
    }

    /**
     * 根据帖子id查出所有评论
     * @param $pid
     * @return array
     */
    public function showComment($pid)
    {
        $comment = $this->postsCommentService->find($pid);

        return compact('comment');
    }

    /**
     * 创建评论
     * @param Request $request
     * @param $pid
     * @return string
     */
    public function createComment(Request $request, $pid)
    {
        $comment = $this->postsCommentService->create($request, $pid);

        return compact('comment');
    }

    /**
     * 查看一篇帖子的Markdown源内容
     * @param $pid
     * @return View
     */
    public function showMarkdown($pid)
    {
        $content = $this->postsService->find($pid)->content;

        return view('blog.home.posts.markdown', compact('content'));
    }
}
