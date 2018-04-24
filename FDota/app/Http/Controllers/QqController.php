<?php

namespace App\Http\Controllers;

use App\Qq;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class QqController extends Controller
{
    protected $app_id = null;
    protected $redirect_uri = null;
    protected $state = null;

    protected $url = [
        'getToken' => 'https://graph.qq.com/oauth2.0/authorize',
        'getOpenid' => 'https://graph.qq.com/oauth2.0/me',
        'getUserInfo' => 'https://graph.qq.com/user/get_user_info',
    ];

    public function __construct() {
        $this->app_id = env('QQ_APPID');
        $this->redirect_uri = env('QQ_REDIRECT_URI');
        $this->state = rand(1000, 9999);
    }

    public function Auth() {
        $params = [
            'response_type' => 'token',
            'client_id' => $this->app_id,
            'redirect_uri' => $this->redirect_uri,
            'state' => $this->state
        ];
        return redirect(urlArrToStr($this->url['getToken'], $params));
    }

    public function getUserInfo() {
        if (!isset($_GET['access_token'])) {
            return view('qq.auth');
        }
        $res = curl($this->url['getOpenid'], ['access_token' => $_GET['access_token']], false, true);
        if(preg_match("/{.*}/i", $res, $matches)){
            $res = json_decode($matches[0]);
            $openid = $res->openid;
            $appid = $res->client_id;
            $params = [
                'access_token' => $_GET['access_token'],
                'oauth_consumer_key' => $appid,
                'openid' => $openid
            ];
            $res = curl($this->url['getUserInfo'], $params, false, true);
            $res = json_decode($res, true);
            $res['nickname'] = userTextEncode($res['nickname']);

            $qq = Qq::firstOrCreate(['nickname' => $res['nickname']], $res);
            $avatar = $qq->figureurl_2 ? $qq->figureurl_2 : $qq->figureurl_1;
            $avatar = httpToHttps($avatar);
            $user = User::firstOrCreate(
                ['qq_id' => $qq->id],
                [
                    'email' => $qq->id . '@fdota.com',
                    'password' => bcrypt(123456789),
                    'name' => $qq->nickname,
                    'avatar' => $avatar
                ]);
            Auth::login($user);
            return redirect('/');
        } else {
            print "not found.";
        }
    }


}
