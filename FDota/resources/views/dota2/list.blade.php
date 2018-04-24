@extends('blog.main')
@section('content')

    <div class="content">
        <p align="left">
            <img src="{{$user->avatar}}" alt="{{$user->username}}" width="42" class="img-rounded" title="{{$user->username}}">
            <span style="font-size: 16px;margin-right:2em">{{$user->username}}</span>
        </p>

        <div class="table-responsive">
            <table class="table table-condensed table-hover table-striped small" style="white-space:nowrap">
                <tr>
                    <th>英雄</th>
                    <th>比赛 ID</th>
                    <th>结束时间</th>
                    <th>结果</th>
                    <th>KDA (K / D / A)</th>
                    <th>物品</th>
                </tr>
                @foreach ($datas as $k=>$data)
                    <tr>
                    <td align="left">
                        <a href="{{url('/'.$data->match_id)}}" style="border: 0px">
                            <img src="{{$heroes->getImgUrlById($data->hero_id)}}" alt="{{$heroes->getDataById($data->hero_id)['localized_name']}}" width="42" class="img-rounded" title="{{$heroes->getDataById($data->hero_id)['localized_name']}}">
                            {{$heroes->getDataById($data->hero_id)['localized_name']}}
                        </a>
                    </td>
                    <td align="left">
                        <a href="{{url('/'.$data->match_id)}}" style="border: 0px">
                            {{$data->match_id}}
                            <br>
                            <font class="gold-color">{{$mods->getDataById($data->game_mode)['name']}}</font>
                        </a>
                    </td>
                    <td align="left">{{\Carbon\Carbon::parse( date('Y-m-d H:i:s', strtotime($data->start_time) - $data->duration) )->diffForHumans()}}</td>
                    <td align="left">@if( ($data->radiant_win == 1 && $data->player_slot <=5) || ($data->radiant_win == 0 && $data->player_slot >5) )<font style="color: #499249 !important;">胜利</font>@else<font style="color: #c23c2a !important;">失败</font>@endif</td>
                    <td align="left">{{ number_format(($data->kills + $data->assists) / ($data->deaths === 0?1:$data->deaths), 1) }}&nbsp;({{$data->kills}}/{{$data->deaths}}/{{$data->assists}})</td>
                    <td align="left">
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
        {!! $datas->render() !!}
    </div>
@endsection
