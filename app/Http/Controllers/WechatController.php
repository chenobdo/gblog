<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\User;
use App\Message;
use Wechat;

class WechatController extends Controller
{
    public function index(Request $request)
    {
        $wechatServer = Wechat::server();
        $wechatServer->setMessageHandler(function ($message) {
            $openid = $message->FromUserName;
            $User = new User();
            $user = $User->select('*')->where('openid', $openid)->first();
            if (!empty($user)) {
                $uid = $user->id;
            } else {
                $uid = $User->insertUser($openid);
            }
            $Message = new Message();
            $Message->insertMsg($uid, 1, $message->Content);
            switch ($message->MsgType) {
                case 'text' :
                    $data = [
                        'key' => config('app.tuling_key'),
                        'info' => $message->Content,
                        'userid' => $message->FromUserName
                    ];
                    $url = config('app.tuling_api');
                    $res = $this->curl($url, 'GET', $data);
                    $rt = json_decode($res);
                    if ($rt->code == 100000) {
                        $Message->insertMsg(1, $uid, $rt->text);
                        return $rt->text;
                    }
                    Log::info('不能理解的话：' . $res);
                    return '不好意思，我不太能理解你说的';
                default :
                    return '你好，我是聊天机器人Gabriel。';
            }
        });

        return $wechatServer->serve();
    }

    /**
     * curl
     * @param string $url 地址
     * @param string $method 方法
     * @param array $data 提交数组
     * @param int $timeout 超时时间
     *
     * @return string or false
     *
     */
    public static function curl($url = '', $method = 'GET', $data = array(), $timeout = 60)
    {
        $ch = curl_init();
        if (strtoupper($method) == 'GET' && $data) {
            $postdata = http_build_query($data, '', '&');
            $url .= '?' . $postdata;
        } elseif (strtoupper($method) == 'POST' && $data) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif (strtoupper($method) == 'JSON' && $data) {
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
