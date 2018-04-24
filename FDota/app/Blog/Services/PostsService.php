<?php

namespace App\Blog\Services;

use App\Blog\Repositories\PostsCommentRepository;
use App\Blog\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PostsService
{
    /** @var PostsRepository */
    protected $postsRepository;

    protected $postsCommentRepository;

    /**
     * PostsService constructor.
     * @param PostsRepository $postsRepository
     */
    public function __construct(
        PostsRepository $postsRepository,
        PostsCommentRepository $postsCommentRepository
    ){
        $this->postsCommentRepository = $postsCommentRepository;

        $this->postsRepository = $postsRepository;
    }

    /**
     * 一篇帖子和标签字符串
     * @param $id
     * @return mixed
     */
    public function findPostAndTagString($id)
    {
        $data = $this->postsRepository->find($id);

        $string = '';

        foreach ($data->tags()->get() as $value) {
            $string .= $value->name . ',';
        }

        $data->tagStr = rtrim($string, ',');

        return $data;
    }

    /**
     * 所有帖子和标签字符串
     * @return mixed
     */
    public function allPostsAndTagsString()
    {
        $data = $this->postsRepository->all();

        foreach ($data as $k => $l) {
            $string = '';

            foreach ($l->tags()->get() as $value) {
                $string .= $value->name . ',';
            }

            $data[$k]->tags = rtrim($string, ',');
        }

        return $data;
    }

    public function getHotPosts($limit)
    {
        $hots = $this->postsCommentRepository->getHotPosts($limit);

        foreach ($hots as $key => $value)
        {
            $posts[$key] = $this->postsRepository->find($value->post_id);
            $posts[$key]->content = mb_substr($posts[$key]->content, 0, 250) . ' ...';
            $posts[$key]->commentTotle = $value->count;
        }

        return $posts;
    }

    /**
     * 获取帖子并传递 关联标签,点击数,解析的Markdown内容
     * @return mixed
     */
    public function all()
    {
        $data = $this->postsRepository->all();

        foreach ($data as $key => $val) {
            foreach ($val->tags()->get() as $tagKey => $tagValue) {
                $data[$key]->tags[$tagKey] = $tagValue;
            }
            $data[$key]->avatar = $val->avatar ? $val->avatar : asset('images/default.jpg');
            $data[$key]->commentTotle = $this->postsCommentRepository->count($val->id);
            // click
            $click = Redis::get('posts:id:'.$val->id);
            $data[$key]->click = $click > 0 ? $click : 0;
            // content
            $content = $val->content;
            $issub = false;
            if (mb_strlen($val->content) > 250)
            {
                $content = mb_substr($val->content, 0, 250) . '...';
                $issub = true;
            }
            $data[$key]->content = $content;
            $data[$key]->issub = $issub;
            // time
            $time = date('m月d日 H:i', $data[$key]->created_at->timestamp);
            if (Carbon::now() < $data[$key]->created_at->addDays(1))
            {
                $time = $data[$key]->created_at->diffForHumans();
            }
            $data[$key]->time = $time;
        }

        return $data;
    }

    /**
     * 根据用户查帖子列表
     * @param $uid
     * @return mixed
     */
    public function findUserPostList($uid)
    {
        return $this->postsRepository->findUser($uid);
    }

    /**
     * 获取一篇帖子并传递 关联标签,解析的Markdown内容
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $data = $this->postsRepository->find($id);

        $data->time = $data->created_at->diffForHumans();

        $data->click = Redis::get('posts:id:' . $data->id);
        $data->click = $data->click > 0 ? $data->click : 0;

        foreach ($data->tags()->get() as $tag) {
            $data->tags[] = $tag;
        }

        return $data;
    }

    /**
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        $user = Auth::user();

        $data = array_merge($data, ['user_id' => $user->id, 'username' => $user->name]);

        return $this->postsRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data)
    {
        if (isset($data['_token'])) unset($data['_token']);

        if (isset($data['tag'])) unset($data['tag']);

        $user = Auth::User();

        array_merge($data, ['user_id' => $user->id, 'username' => $user->name]);

        if ($this->postsRepository->update($id, $data)) {
            return $id;
        }
        return 0;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->postsRepository->delete($id) ? $id : 0;
    }

    /**
     * @param $key
     * @param $val
     * @return int
     */
    public function whereDelete($key, $val)
    {
        return $this->postsRepository->whereDelete($key, $val) ? $val : 0;
    }

    /**
     * 24小时内是否重复阅读过某篇帖子,没有则incr一次
     * @param $postId
     */
    public function whetherToReadThePost($postId)
    {
        $ip = getIpAddr();
        $readKey = 'read_posts:ip:' . $ip;
        $postKey = 'posts:id:' . $postId;
        if ($read = Redis::get($readKey)) {
            $read = explode(',', $read);
            if (!in_array($postId, $read)) {
                array_push($read, $postId);
                $str = '';
                foreach ($read as $val) {
                    $str .= $val . ',';
                }
                $str = rtrim($str);
                Redis::set($readKey, $str);
                Redis::expire($readKey, 60*60*24);
                Redis::incr($postKey);
            }
        } else {
            Redis::set($readKey, $postId);
            Redis::incr($postKey);
        }
    }
}