<?php

namespace App\Http\Controllers\Dota2;

use App\Dota2\Model\Matche;
use App\Dota2\Model\Slot;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Dota2Api\Data\Heroes;
use Dota2Api\Data\Items;
use Dota2Api\Data\Lobbies;
use Dota2Api\Data\Mods;
use Dota2Api\Mappers\MatchesMapperWeb;
use Dota2Api\Mappers\MatchMapperDb;
use Illuminate\Http\Request;

use App\Http\Requests;
use Dota2Api\Api;
use Dota2Api\Mappers\MatchMapperWeb;
use Dota2Api\Mappers\PlayersMapperWeb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Dota2Controller extends Controller
{

    protected $account_id;

    protected $items;
    protected $heroes;
    protected $mods;
    protected $lobbies;

    public function __construct(Heroes $Heroes, Items $Items, Mods $Mods, Lobbies $Lobbies)
    {
        $Heroes->parse();
        $Items->parse();
        $Mods->parse();
        $Lobbies->parse();
        $this->heroes = $Heroes;
        $this->items = $Items;
        $this->mods = $Mods;
        $this->lobbies = $Lobbies;
        Api::init(env('API_KEY'), array(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'), env('DOTA2_TABLE_PREFIX')));
        View::share('active', ['dota2' => 'layui-this']);
    }

    public function getIndex()
    {
        $me = User::first();
        $this->account_id = $me->account_id;

        $count = Slot::where('account_id', $this->account_id)->count();
        if ($count == 0) {
            $this->loadMatchs();
        }
        $data = Matche::join('slots', 'slots.match_id', 'matches.match_id')->where('slots.account_id', $this->account_id)->orderBy('matches.match_id', 'desc')->paginate(10);

        $viewData = [
            'user' => $me,
            'datas' => $data,
            'mods' => $this->mods,
            'items' => $this->items,
            'heroes' => $this->heroes,
        ];
        return view('dota2.list', $viewData);
    }

    public function getInfo($match_id)
    {
        $match = Matche::where('match_id', $match_id)->first();
        $slots = Slot::where('match_id', $match_id)->orderBy('slots.player_slot', 'asc')->get();
        $team = $this->addUserInfoToData($slots);
        list($radiant, $dire) = $team;
        $viewData = [
            'radiant' => $radiant,
            'dire' => $dire,
            'match' => $match,
            'mods' => $this->mods,
            'items' => $this->items,
            'heroes' => $this->heroes,
        ];
        return view('dota2.info', $viewData);
    }





    protected function loadMatchs() {
        $matchesMapperWeb = new MatchesMapperWeb();
        $matchesMapperWeb->setAccountId($this->account_id);
        $matchesMapperWeb->setMatchesRequested(25);
        $matchesShortInfo = $matchesMapperWeb->load();

        foreach ($matchesShortInfo as $k=>$Info) {
            $row = Matche::join('slots', 'slots.match_id', 'matches.match_id')->where('slots.match_id', $k)->where('slots.account_id', $this->account_id)->first();
            if ($row) {
                break;
            }
            $matchMapper = new MatchMapperWeb($k);
            $match = $matchMapper->load();
            $MatchMapperDb = new MatchMapperDb();
            $MatchMapperDb->save($match);
        }
    }

    protected function getUserInfo($data) {
        $playersMapperWeb = new PlayersMapperWeb();
        $playersInfo = $playersMapperWeb;
        foreach ($data as $id) {
            $steamId = $id + 76561197960265728;
            $playersInfo = $playersInfo->addId($steamId);
        }
        $playersInfo = $playersInfo->load();
        foreach ($playersInfo as $info) {
            $infos[$info->get('steamid') - 76561197960265728] = $info;
        }
        return $infos;
    }


    protected function addUserInfoToData($slots) {
        foreach ($slots as $slot) {
            $data[] = $slot->account_id;
        }
        $playersInfo = $this->getUserInfo($data);
        $radiant = [];
        $dire = [];
        foreach ($slots as $key=>$slot) {
            if (array_key_exists($slot->account_id, $playersInfo)) {
                $player = $playersInfo[$slot->account_id];
                $slot->username = $player->get('personaname');
                $http = 'http://cdn.dota2.com/steamcommunity/public/images/avatars/';
                $slot->avatar = $http . preg_replace('/\.jpg/', '_medium.jpg', $player->get('avatar'));
            } else {
                $slot->username = '匿名玩家';
                $slot->avatar = 'http://cdn.dota2.com/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_medium.jpg';
            }
            if ($key < 5) {
                array_push($radiant, $slot);
            } else {
                array_push($dire, $slot);
            }
        }
        return [$radiant, $dire];
    }
}
