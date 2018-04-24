@extends('blog.main')
@section('content')

    <div class="content">
        {{$match->start_time}}
        <div class="table-responsive">
            <p class="radiant" style="text-align: left;width: 98%;margin-right: auto;margin-left: auto;">
                天辉
                @if($match->radiant_win == 1)<font style="color:#92A525; font-size:18px">(获胜)</font>@endif
            </p>
            <table class="table table-condensed table-hover table-striped small" style="white-space:nowrap">
                <tr>
                    <th></th>
                    <th style="line-height: 3">Players</th>
                    <th style="line-height: 3">Hero</th>
                    <th class="gold-color">KDA<br>K/D/A</th>
                    <th style="line-height: 3">伤害</th>
                    <th style="line-height: 3">正/反补</th>
                    <th style="line-height: 3">经验/分钟</th>
                    <th style="line-height: 3">金钱/分钟</th>
                    <th style="line-height: 3">建筑伤害</th>
                    <th style="line-height: 3">英雄治疗</th>
                    <th style="line-height: 3">物品</th>
                </tr>
                @foreach($radiant as $data)
                <tr>
                    <td align="left">
                        <img src="{{$data->avatar}}" alt="{{$data->username}}" width="32" class="img-circle" title="{{$data->username}}">
                    </td>
                    <td align="left">
                        <a href="javascript:" style="line-height: 3;font-size:{{48/strlen($data->username)}}px;color:#c23c2a;font-weight: 500;border-bottom: none;">{{$data->username}}</a>
                    </td>
                    <td>
                        <img src="{{$heroes->getImgUrlById($data->hero_id)}}" alt="{{$heroes->getDataById($data->hero_id)['localized_name']}}" width="42" class="img-rounded" title="{{$heroes->getDataById($data->hero_id)['localized_name']}}">
                        <br>
                        {{$data->level}}
                    </td>
                    <td>
                        <div class="match-number" style="margin-bottom: 0px;color:#f0a868">{{ number_format(($data->kills + $data->assists) / ($data->deaths === 0?1:$data->deaths), 1) }}</div>
                        {{$data->kills}}/{{$data->deaths}}/{{$data->assists}}
                    </td>
                    <td style="line-height: 3">
                        {{$data->hero_damage}}
                    </td>
                    <td style="line-height: 3">
                        {{$data->last_hits}}/{{$data->denies}}
                    </td>
                    <td style="line-height: 3">
                        {{$data->xp_per_min}}
                    </td>
                    <td style="line-height: 3">
                        {{$data->gold_per_min}}
                    </td>
                    <td style="line-height: 3">
                        {{$data->tower_damage}}
                    </td>
                    <td style="line-height: 3">
                        {{$data->hero_healing}}
                    </td>
                    <td align="left" style="line-height: 3">
                        @for($i=0; $i<6; $i++)
                            <?php $index = 'item_' . $i; ?>
                            <?php $index = $data->$index; ?>
                            @if(!empty($items->getImgUrlById($index)))
                                <img src="{{$items->getImgUrlById($index)}}" alt="" width="32" class="img-rounded" title="">
                            @endif
                        @endfor
                    </td>
                </tr>
                @endforeach
            </table>

            <p class="dire" style="text-align: left;width: 98%; margin-left: auto;margin-right: auto;">
                夜魇
                @if($match->radiant_win != 1)<font style="color:#92A525; font-size:18px">(获胜)</font>@endif
                <span style="font-size: 12px;float:right;color:#999;">数据来自 www.fdota.com  最不专业的游戏数据平台</span>
            </p>

            <table class="table table-condensed table-hover table-striped small" style="white-space:nowrap">
                <tr>
                    <th></th>
                    <th style="line-height: 3">Players</th>
                    <th style="line-height: 3">Hero</th>
                    <th class="gold-color">KDA<br>K/D/A</th>
                    <th style="line-height: 3">伤害</th>
                    <th style="line-height: 3">正/反补</th>
                    <th style="line-height: 3">经验/分钟</th>
                    <th style="line-height: 3">金钱/分钟</th>
                    <th style="line-height: 3">建筑伤害</th>
                    <th style="line-height: 3">英雄治疗</th>
                    <th style="line-height: 3">物品</th>
                </tr>
                @foreach($dire as $data)
                    <tr>
                        <td align="left">
                            <img src="{{$data->avatar}}" alt="{{$data->username}}" width="32" class="img-circle" title="{{$data->username}}">
                        </td>
                        <td align="left">
                            <a href="javascript:" style="line-height: 3;font-size:{{48/strlen($data->username)}}px;color:#c23c2a;font-weight: 500;border-bottom: none;">{{$data->username}}</a>
                        </td>
                        <td>
                            <img src="{{$heroes->getImgUrlById($data->hero_id)}}" alt="{{$heroes->getDataById($data->hero_id)['localized_name']}}" width="42" class="img-rounded" title="{{$heroes->getDataById($data->hero_id)['localized_name']}}">
                            <br>
                            {{$data->level}}
                        </td>
                        <td>
                            <div class="match-number" style="margin-bottom: 0px;color:#f0a868">{{number_format(($data->kills+$data->assists)/($data->deaths === 0?1:$data->deaths), 1)}}</div>
                            {{$data->kills}}/{{$data->deaths}}/{{$data->assists}}
                        </td>
                        <td style="line-height: 3">
                            {{$data->hero_damage}}
                        </td>
                        <td style="line-height: 3">
                            {{$data->last_hits}}/{{$data->denies}}
                        </td>
                        <td style="line-height: 3">
                            {{$data->xp_per_min}}
                        </td>
                        <td style="line-height: 3">
                            {{$data->gold_per_min}}
                        </td>
                        <td style="line-height: 3">
                            {{$data->tower_damage}}
                        </td>
                        <td style="line-height: 3">
                            {{$data->hero_healing}}
                        </td>
                        <td align="left" style="line-height: 3">
                            @for($i=0; $i<6; $i++)
                                <?php $index = 'item_' . $i; ?>
                                <?php $index = $data->$index; ?>
                                @if(!empty($items->getImgUrlById($index)))
                                    <img src="{{$items->getImgUrlById($index)}}" alt="" width="32" class="img-rounded" title="">
                                @endif
                            @endfor
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
