<?php

namespace App\Blog\Repositories;

use App\Blog\Model\Posts;

class PostsRepository
{
    /** @var Posts 注入 Posts model */
    protected $posts;

    /**
     * PostsRepository constructor.
     * @param Posts $posts
     */
    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    /**
     * 获取所有
     * @return mixed
     */
    public function all()
    {
        return $this->posts
            ->select('posts.*', 'users.avatar')
            ->join('users', 'users.id', 'posts.user_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * 获取一条
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->posts->where('id', $id)->first();
    }

    /**
     * 根据用户查帖子列表
     * @param $uid
     * @return mixed
     */
    public function findUser($uid)
    {
        return $this->posts
            ->select('id', 'title', 'created_at')
            ->where('user_id', $uid)
            ->get();
    }

    /**
     * 创建
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return $this->posts->create($data);
    }

    /**
     * 更新
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->posts->where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->posts->where('id', $id)->delete();
    }

    /**
     * @param $key
     * @param $val
     * @return mixed
     */
    public function whereDelete($key, $val)
    {
        return $this->posts->where($key, $val)->delete();
    }
}