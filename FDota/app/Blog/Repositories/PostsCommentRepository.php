<?php

namespace App\Blog\Repositories;

use App\Blog\Model\PostsComment;
use Illuminate\Support\Facades\DB;

class PostsCommentRepository
{
    /** @var PostsComment 注入 PostsComment model */
    protected $postsComment;

    /**
     * PostsCommentRepository constructor.
     * @param PostsComment $postsComment
     */
    public function __construct(PostsComment $postsComment)
    {
        $this->postsComment = $postsComment;
    }

    /**
     * 通过帖子id查询关联评论
     * @param $postId
     * @return mixed
     */
    public function find($postId)
    {
        return $this->postsComment->select(
                'posts_comment.id',
                'posts_comment.content',
                'posts_comment.created_at',
                'users.name',
                'users.avatar'
            )
            ->where('post_id', $postId)
            ->join('users', 'posts_comment.user_id', 'users.id')
            ->orderBy('posts_comment.created_at', 'desc')
            ->get();
    }

    public function getHotPosts(int $limit)
    {
        return $this->postsComment
            ->select('post_id', DB::raw('count(*) as count'))
            ->groupBy('post_id')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * @param int $postId
     * @return mixed
     */
    public function count(int $postId)
    {
        return $this->postsComment->where('post_id', $postId)->count();
    }

    /**
     * create
     * @param $request
     * @return static
     */
    public function create($request)
    {
        return $this->postsComment->create($request);
    }
}
