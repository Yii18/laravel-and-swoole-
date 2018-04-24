<?php

namespace App\Blog\Services;

use App\Blog\Repositories\PostsCommentRepository;
use Illuminate\Support\Facades\Auth;

class PostsCommentService
{
    /** @var PostsCommentRepository  */
    protected $postsCommentRepository;

    /**
     * PostsCommentService constructor.
     * @param PostsCommentRepository $postsCommentRepository
     */
    public function __construct(PostsCommentRepository $postsCommentRepository)
    {
        $this->postsCommentRepository = $postsCommentRepository;
    }

    /**
     * 没头像的用户采用默认头像
     * @param $postId
     * @return mixed
     */
    public function find($postId)
    {
        $data = $this->postsCommentRepository->find($postId);

        foreach ($data as $key => $val) {
            $data[$key]->avatar = $val->avatar ? $val->avatar : asset('images/default.jpg');
            $data[$key]->content = $val->content;
        }

        return $data;
    }

    /**
     * 创建评论返回json
     * @param $request
     * @param $postId
     * @return string
     */
    public function create($request, $postId)
    {
        $user = $request->user();

        $comment = $this->postsCommentRepository->create(
            array_merge($request->all(), ['user_id' => $user->id, 'post_id' => $postId])
        );

        if ($comment) {
            $user->avatar = $user->avatar ? $user->avatar : asset('images/default.jpg');

            return [
                'id' => $comment->id,
                'avatar' => $user->avatar,
                'name' => $user->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at
            ];
        }

        return ['errCode' => '500'];
    }
}