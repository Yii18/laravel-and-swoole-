<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::firstOrCreate(['email' => $data['email']], [
            'name' => $data['name'],
            'username' => '',
            'avatar' => '',
            'steamid' => '',
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postCreate(Request $request) {
        $this->validator($request->all())->validate();

        $data = $request->all();

        $username = $data['name'];
        $password = md5(trim($data['password'])); //加密密码
        $email = trim($data['email']); //邮箱
        $regtime = time();

        $token = md5($username.$password.$regtime); //创建用于激活识别码

        Redis::set($token, json_encode($data));
        Redis::expire($token, 60*60);

        $url = config('app.url') . '/register/verify/' . $token;
        Mail::send('emails.register', ['name' => $username, 'url' => $url], function($message) use ($email){
            $message->to($email)->subject('请完成你的 Fdota 账号注册');
        });

        return ['msg' => '请登录邮箱激活账号,1小时内有效'];
    }

    public function verify($token) {
        $json = Redis::get($token);
        if (empty($json)) {
            return ['errMsg' => '验证过期或者已完成'];
        }
        $data = json_decode($json, true);
        $user = User::firstOrCreate(['email' => $data['email']], [
            'name' => $data['name'],
            'username' => '',
            'avatar' => '',
            'steamid' => '',
            'password' => bcrypt($data['password']),
        ]);

        $this->guard()->login($user);
        return redirect('/');
    }

}
