<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class WechatController extends Controller
{
    public function index(Request $request)
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            Log::info($message);
            switch ($message->MsgType) {
                case 'text' :
                    $data = [
                        'key' => '53be621f65af4fca87da2f527da08081',
                        'info' => '今天天气怎么样',
                        'userid' => '123456'
                    ];
                    $url = 'http://www.tuling123.com/openapi/api';
                    $res = $this->curl($url, 'GET', $data);
                    $rt = json_decode($res);
                    if ($rt['code'] == 10000) {
                        return $rt['text'];
                    }
                    return '能再说一边吗？我没有听清';
                default :
                    return '说人话';
            }
        });

        return $wechat->server->serve();
    }

    /**
     * curl
     * @param string    $url        地址
     * @param string    $method     方法
     * @param array     $data       提交数组
     * @param int       $timeout    超时时间
     *
     * @return string or false
     *
     */
    public static function curl($url = '', $method = 'GET', $data = array(), $timeout = 60)
    {
        $ch = curl_init();
        if(strtoupper($method) == 'GET' && $data){
            $postdata = http_build_query($data, '', '&');
            $url .= '?'.$postdata;
        } elseif (strtoupper($method) == 'POST' && $data){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif(strtoupper($method) == 'JSON' && $data) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $response = false;
        }
        curl_close($ch);
        return $response;
    }
}
