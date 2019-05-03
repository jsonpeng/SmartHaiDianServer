<?php

namespace App\Http\Controllers\Front;

use Yansongda\Pay\Pay;
use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubmitLog;
use EasyWeChat\Factory;

class PayController extends Controller
{
    protected $alipay_config = [
        'app_id' => '2018072560803323',
        'notify_url' => '/alipay/notify',
        'return_url' => '/alipay/return',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApV1yvR9FQ+OzADEQYKgs9W0UVG50NZ17Qw5iSUCHwDMpLuKQ3TRPApgpUcIImwrc9bzxihTUS1BbKsw22icV5xqLLmG1vGQnbVsycJqDsVe9ddCVC0lZ6Bf8x9uvPZaPZY6FwJMMfU4310ekZGgwwx+khZZM0on58hwy8VBWHFulf4wAF9KALV39DJ+NelJ6lFLvl9UzIeWPSZyyZmvo+Yf57ie8Vg4NWHumWTc+rVpVc/MyTMOnKd8SQZkhdWSy5I5cLzHVD0wFpTHYOo+jPTQUqblg8nsVwHl/arxoSCYgKkUpLjJdpqYgfB6J6DuXPqN191CUnY6Vs2hXzq6TtwIDAQAB',
        // 加密方式： **RSA2048**  
        'private_key' => 'MIIEowIBAAKCAQEA6Fbzu6H1AG1BUcz14S3bQZWMXQo84kCL67j4XHYszGmu/BGRuQs2m3AnPSZURn1ujk0cdvr2vR3BPyUz88Z891y/j6ktw4L+QRpmoVP933otuL2a+myD3Tu+KA6XZF0uaN/TD7WVoyH8IKecZ82XEwFKhIDaJu0/lhM4Kv4i2XncG9Yeh6UdLyGuc3RFhvwztF1QsvQy9rfl4uMf6ZJuihlAroyvAScZe7SAg/fBj2PsXPSnJgntXHKrjz2rT1IOOWfw4mi7+COlbZy87MOhtyY3kZat4VeNsrzQp1W8jybhqW5p2UkrXVxfQfWoVVP5ffnNOGjAUg6gyosKJrdmsQIDAQABAoIBAArG/cdWW+cJKl6BA2bOmb0REtG+B9T26Yalrd+cG7ffrx5CMmBDBOVw7mEHxiD+8IHpUcizG37qQmyLbT2Bl4ph4wDm+Bh5mxGqB9iz7LLRGA3ZvbagEf3RJ6D0DFG7gMuclk3EPoyypt9c5wRppPhctvgugfAMUUbE3XYhE7zCs7InnybEV1hXO/M6kGRAci3xDuMiqY3tn/ShvZ08RmQoyqXZsYn3EZ2q4K0RPuBV2NHyBz7fGbEHqZkHA2e0CkwRtM/4joQJ5ZiwY0bDAs13fBs990MMK3mtBt+tBSatg8mrK79WQkrcKTyc8aUPklFW2BAke3ny+B/Od9BuC4ECgYEA97xuMQa8/cUOcMeh/fd9MV4GDTksPZYqIp9+PV3egq2Z8CaBXonqZEpk1NJKENRixcEjIcAwFAKH9xS8o7kzTEXLatvlPq9NmZW9ydwGTbxOerSbw0OZb23cBUEFQ2bwku7bI/F2zfrY+mFvCpE26+VOKPiTN8Nx4HMAcU3J++cCgYEA8BcK2W2/3FNKHyXiJKDw/m5SJCISV69xpW5d9X6+ZRaAwywOu/J4XTb+99Mza+GuMLs94kpehHTACqbqbL9C99ZOTUtzcsrSikcy03lOCdWY8+AsjujoAtRUnzbUG+CTvfSZjcdQ4VUreFlEve8geU8kHOyWk3fWg3oEkNsg9acCgYEAhHVSsZH5wPH466JB4gnO/XNZZv6XwgIlW0fN9r/W9iYeNcJQz5yMH72LNiOOCHuWqEfBIg2hZ0GHMzv6NMwUOobi4arbYu3WXvUqeeDT2gKCL6eb1Qay5lpmFsUSLFzA6r8dmpVDwZSLKSypc4v7Qpvjc5KdHGa635h9txcxlScCgYBHC3qBZpGMn/TiDLLDhgBqObkCyjZFTjxB6MvS9mNexG7r0iC2CwUFCF4gdZXUyZ5i+zVPvhQD/AxL2qKp9VravcbD5pzODiiJFJJ8s3udO2CcYeytiUwGclBsIKxZZ3Ywkq3Rn3ZWh35qiXfnAFjKrNmR2YyhLKgEldm+B6nUJwKBgHy3UJsWjEZ6ApqSKxL1AqcWTGqLFphexEbiW/WS8dGT7Q5IO3bb1Y3m+9kdPR/ZxhBYqlcpBJMizNvHmR6QDXfKcZWnXVuSq6nKikznPb5uzGz4eeqRM1OPzAB+MeH12T9kpcJ6ZW5vHWSTpsQulwY3TSr7WrQPcyZGzgaMo5CQ',
        'log' => [ // optional
            'file' =>'./logs/pay.log',
            'level' => 'debug'
        ],
       // 'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];

     protected $wechat_config = [
        'appid' => 'wx0f5e37c357fcd593', // APP APPID
        'app_id' => 'wx0f5e37c357fcd593', // 公众号 APPID
        'miniapp_id' => 'wxb3fxxxxxxxxxxx', // 小程序 APPID
        'mch_id' => '1513531551',
        'key' => 'goPDvO7z7aGuljG8mtAcUasmfcKETh5t',
        'notify_url' => 'http://www.yingwenquming.com/wechat/notify',
        'cert_client' => './cert/apiclient_cert.pem', // optional，退款等情况时用到
        'cert_key' => './cert/apiclient_key.pem',// optional，退款等情况时用到
        'log' => [ // optional
            'file' => './logs/wechat.log',
            'level' => 'debug'
        ],
        //'mode' => 'dev', // optional, dev/hk;当为 `hk` 时，为香港 gateway。
    ];

    public function index(Request $request)
    {
        $user = auth('web')->user();
        $input = session('gol_house_pay_'.$user->id);
        if(!empty($input)){
            $join_house = app('common')->houseRepo()->joinHouse($user->id,$input);
            $order = [
                'out_trade_no' => $join_house->number,
                'total_amount' => $input['price'],
                'subject' => '购买小屋权益',
            ];
            $config = $this->alipay_config;
            $config['notify_url'] = 'https://'.$_SERVER["HTTP_HOST"].$config['notify_url'];
            $config['return_url'] = 'https://'.$_SERVER["HTTP_HOST"].$config['return_url'];
            $alipay = Pay::alipay($config)->web($order);
            return ($alipay);
        }
        else{
            return redirect('/');
        }
    }

    public function return(Request $request)
    {
        $config = $this->alipay_config;
        $config['notify_url'] = 'https://'.$_SERVER["HTTP_HOST"].$config['notify_url'];
        $config['return_url'] = 'https://'.$_SERVER["HTTP_HOST"].$config['return_url'];
        $data = Pay::alipay($config)->verify(); // 是的，验签就这么简单！
        $input = $request->all();
        $log_id = explode('_', $input['out_trade_no'])[1];

        $SubmitLog = app('common')->houseJoinRepo()->findWithoutFail($log_id);

        if(!empty($SubmitLog)){
            $SubmitLog->update(['pay_status'=>'已支付','pay_platform'=>'支付宝']);
        }

        return redirect('/user/center/order');
        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
    }


    //支付宝通知
    public function notify()
    {
        $config = $this->alipay_config;
        $config['notify_url'] = 'https://'.$_SERVER["HTTP_HOST"].$config['notify_url'];
        $config['return_url'] = 'https://'.$_SERVER["HTTP_HOST"].$config['return_url'];
        $alipay = Pay::alipay($config);
    
        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::info('Alipay notify', $data->all());
        } catch (Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }

    //h5 wap付
    public function weixinWeb($id)
    {
        $price = empty(getSettingValueByKey('name_price')) ? 1 :getSettingValueByKey('name_price');
        $order = [
            'out_trade_no' => $id.'_'.time(),
            'total_fee' => $price*100, // **单位：元**
            'body' => '购买英文名字',
        ];
         return (Pay::wechat($this->wechat_config)->wap($order));
    }

    //微信扫码付
    public function weixinIndex($id)
    {
        $price = empty(getSettingValueByKey('name_price')) ? 1 :getSettingValueByKey('name_price');
        $order = [
            'out_trade_no' => $id.'_'.time(),
            'total_fee' => $price*100, // **单位：分**
            'body' => '购买英文名字',
        ];

        $result = Pay::wechat($this->wechat_config)->scan($order)->code_url;
        $size = 200;
        $path='/qrcodes/'.str_random(10).'.png';
        \QrCode::format('png')->size($size)->generate($result,public_path($path));
        return ['image'=>'http://'.$_SERVER['HTTP_HOST'].$path,'result'=>$result];
    }

    //微信异步通知
    public function weixinNotify()
    {
        $pay = Pay::wechat($this->wechat_config);
        try{
            $data = $pay->verify(); // 是的，验签就这么简单！
            $message = $data->all();
            #订单号中取出id
            $log_id = explode('_', $message['out_trade_no'])[0];
            $SubmitLog = SubmitLog::find($log_id);

            if(empty($SubmitLog) || $SubmitLog->pay_status == '已支付'){
                return;
            }
             ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $SubmitLog->update(['pay_status'=>'已支付','pay_platform'=>'微信']);
                // 用户支付失败
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    
                }
            } 
            else {
                return $fail('通信失败，请稍后再通知我');
            }
            //Log::debug('Wechat notify', $data->all());
        } catch (Exception $e) {
            // $e->getMessage();
        }
        
        return $pay->success();// laravel 框架中请直接 `return $pay->success()`
    }

}