<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DanmuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json = file_get_contents('http://api.douyutv.com/api/v1/live/dota2');

        $list = json_decode($json)->data;

        $room = [];

        foreach ($list as $l)
        {
            $room[$l->room_id] = [];
        }

        $room = json_encode($room);

        return view('danmu.list', compact('list', 'room'));
    }

    protected function getRandom($param){
        $str="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $key = "";
        for($i=0;$i<$param;$i++) {
            $key .= $str{mt_rand(0,35)};
        }
        return $key;
    }

    protected function curls($url, $data_string)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-AjaxPro-Method:ShowList',
            'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomId = $id;
        $bashUrl = "http://www.douyu.com/lapi/live/getPlay/{$roomId}";
        $did = $this->getRandom(32);
        $time = ~~(time()/60);
        $sign = md5("{$roomId}{$did}A12Svb&%1UUmf@hC{$time}");

        $payload = [
            'sign' => $sign,
            'rate' => '0',
            'did' => $did,
            'tt' => $time,
            'cdn' => 'ws'
        ];

        $res = json_decode($this->curls($bashUrl, http_build_query($payload)));

        if ($res->error === 0)
        {
            $data = $res->data;
            $flvHttp = $data->rtmp_url . '/' . $data->rtmp_live;

            // flv流输出
            $handle = fopen($flvHttp, 'rb');
            header('Content-Type:application/octet-stream');
            while (!feof($handle)) {
                echo fread($handle, 8192);
            }
            fclose($handle);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
