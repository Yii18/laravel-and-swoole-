<?php

namespace App\Http\Controllers;

use Invisnik\LaravelSteamAuth\SteamAuth;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
    * @var SteamAuth
    */
    private $steam;

    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    public function login()
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        $authUser = Auth::User();
        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();
            if (!is_null($info)) {
                $user = User::updateOrCreate(['id' => $authUser->id], [
                    'username' => $info->personaname,
                    'avatar' => $info->avatarfull,
                    'steamid'  => $info->steamID64,
                    'account_id'  => $info->steamID64 - 76561197960265728
                ]);
                Auth::login($user, true);
                return redirect('/'); // redirect to site
            }
        }
        return $this->steam->redirect(); // redirect to Steam login page
    }
}
