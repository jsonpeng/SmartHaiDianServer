<?php
use Log as SmartLog;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use App\Models\Region;

/**
 * 智能帮助函数
 */
trait SmartHelper{

    /**
     * 判断java返回的正确值
     * @param  [type] $result [description]
     * @return [type]         [description]
     */
    public static function returnVarifyJavaResultData($result)
    {
        $result = json_decode($result,1);

        if(isset($result['code']) && (int)$result['code'] === 0)
        {
            return zcjy_callback_data($result['msg']);
        }
        else{
            return zcjy_callback_data('请求异常',1);
        }
    }

    /**
     * 获取设备型号名称
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public static function getModelName($model)
    {
        return isset(self::$deviceType[$model]) ? self::$deviceType[$model] : '未知设备';
    }


    /**
     * 获取设备的状态
     * @param  [type] $device [description]
     * @return [type]         [description]
     */
    public static function getDeviceState($device)
    {
        if(isset($device->state) && (int)($device->state) === 1 && isset($device->agt_state) && (int)($device->agt_state) === 1)
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * 获取设备是否可以支持控制
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public static function getDeviceWhetherSupportSwitch($model)
    {
        if(in_array($model, self::$switchDeviceModel))
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * 获取灯光可以支持的idx类型
     * @param  [type] $light [description]
     * @return [type]        [description]
     */
    public static function getLightSupportIdx($light)
    {
        $supportIdx = '';
        if(isset($light->support_rgb) && (int)$light->support_rgb === 1)
        {
            $supportIdx .= 'RGB,';
        }

        if(isset($light->support_rgbw) && (int)$light->support_rgbw === 1)
        {
            $supportIdx .= 'RGBW,';
        }

        if(isset($light->support_dyn) && (int)$light->support_dyn === 1)
        {
            $supportIdx .= 'DYN';
        }

        if(substr($supportIdx, -1) == ',')
        {
            $supportIdx = substr($supportIdx, 0,-1);
        }
        return $supportIdx;
    }

    /**
     * 获取区域描述
     * @param  [type] $region_name [description]
     * @return [type]              [description]
     */
    public static function getRegionDescByName($region_name)
    {
        return isset(self::$regionConf[$region_name]) ? self::$regionConf[$region_name] : '无';
    }

    /**
     * 获取区域名称详细
     * @param  [type] $region_id [description]
     * @return [type]            [description]
     */
    public static function getRegionName($region_id)
    {
        return optional(Region::find($region_id))->desc;
    }

    /**
     * 获取展示名称
     * @param  [type] $type  [description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public static function getDisplayName($param,$type = 'sensorType')
    {   
        return isset((self::${$type})[$param]) ? (self::${$type})[$param] : '未知';
    }

    /**
     * 简单guzzle请求func
     * @param  string $url    [description]
     * @param  string $method [description]
     * @param  array  $param  [description]
     * @return [type]         [description]
     */
    public static function simpleGuzzleRequest($url= '',$method='GET',$param= [])
    {
        try{

            $client = new Client();
            $url_suffix = '?';
            if(is_array($param) && count($param))
            {
                foreach ($param as $key => $value) 
                {
                    $url_suffix .= $key.'='.$value.'&';
                }
                $url_suffix = substr($url_suffix,0,strlen($url_suffix)-1); 
            }
            $url .= $url_suffix;
            SmartLog::info('请求地址:'.$url);
            $response = $client->request($method, $url);
            return $response->getBody();
        }catch(Exception $e){
            return '请求异常';
        }
    }

    /**
     * 发起guzzel请求
     */
    public static function guzzleRequest($request_config = array('url'=>'','method'=>'GET','form'=>'','headers'=>''), $type = "api")
    {
        try{
            $client = new Client();
            $response = $client->request($request_config['method'], $request_config['url'], [
                'headers' => isset($request_config['headers']) ? $request_config['headers'] : [] ,
                'form_params' => $request_config['form']
            ]);
            // return ($response);
            #解析结果
            $data = json_decode($response->getBody(),true);
            return zcjy_callback_data($data,0,$type);
        } catch (Exception $e) {
            return zcjy_callback_data('请求异常',1,$type);
        }
       
    }

 }