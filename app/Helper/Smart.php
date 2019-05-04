<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use App\Models\Region;
use App\Models\DevLight;
use App\Models\DevSensor;
use App\Models\DevScene;
use App\Models\DevCurtain;

use Cache as SmartCache;
use Config as SmartConfig;
use Log as SmartLog;

class Smart{

     use SmartDataShow,SmartControl,SmartCacheService,SmartContent,SmartHelper;

 }

/**
 * 常量管理
 */
trait SmartContent{

     //java 多个控制接口
    public static $javaRequestUrl = "http://picc.nat300.top/api/device/";

    //传感器类型
    public static $sensorType = 
    [
        '1' => '气体感应器(甲醛)',
        '2' => '气体感应器(燃气)',
        '3' => '环境感应器(TVOC+CO2)'
    ];

    //智能设备通用状态
    public static $state = [
        '0' => '离线',
        '1' => '在线'
    ];

    //智能设备接入状态
    public static $is_join = [
        '0' => '未接入',
        '1' => '已接入'
    ];

    //传感器报警状态
    public static $alarm_sound = [
        '0' => '未报警',
        '1' => '报警'
    ];

   //支持控制的设备模型
    public static $switchDeviceModel =
    [
        'SL_SPOT'    ,
        'SL_LI_RGBW' ,
        'SL_CT_RGBW' ,
        'SL_SC_CP'   ,
        'SL_DOOYA'
    ];

    //灯光设备模型
    public static $lightDeviceModel =
    [
        'SL_SPOT'    ,
        'SL_LI_RGBW' ,
        'SL_CT_RGBW' 
    ];

    //燃气设备模型
    public static $cpDeviceModel =
    [
        'SL_SC_CP'
    ];

    //环境设备模型
    public static $cqDeviceModel =
    [
        'SL_SC_CQ'
    ];

    //窗帘电机模型
    public static $dooyaDeviceModel = 
    [
        'SL_DOOYA'
    ];

    /**
     * 模型类型
     * @var [type]
     */
    public static $modelType = 
    [
        'SL_SPOT'    => '智能灯光设备',
        'SL_LI_RGBW' => '智能灯光设备',
        'SL_SC_CP'   => '燃气传感器',
        'SL_SC_CQ'   => '环境传感器',
        'SL_CT_RGBW' => '智能灯光设备'
    ];

    //设备状态对应的类型
    public static $deviceType = 
    [
        'SL_SPOT'    => '超级碗',
        'SL_LI_RGBW' => '幻彩灯泡',
        'SL_SC_CP'   => '燃气传感器',
        'SL_SC_CQ'   => '环境传感器',
        'SL_CT_RGBW' => '灯带'
    ];

    //设备控制idx类型
    public static $controlIdx = 
    [
        'SL_SPOT'    => 'RGB',
        'SL_LI_RGBW' => 'RGBW',
        'SL_SC_CP'   => 'P3',
        'SL_CT_RGBW' => 'RGBW',
        'SL_DOOYA'   => 'P2'
    ];

    //设备控制开 参数
    public static $controlOpenParam = 
    [
        'SL_SPOT'    => ['type'=>'0x81','val'=>'1'],
        'SL_LI_RGBW' => ['type'=>'0x81','val'=>'1'],
        'SL_SC_CP'   => ['type'=>'0x81','val'=>'1'],
        'SL_CT_RGBW' => ['type'=>'0x81','val'=>'1'],
        'SL_DOOYA'   => ['type'=>'0xCF','val'=>'100']
    ];

    //设备控制关 参数
    public static $controlCloseParam = 
    [
        'SL_SPOT'    => ['type'=>'0x80','val'=>'0'],
        'SL_LI_RGBW' => ['type'=>'0x80','val'=>'0'],
        'SL_SC_CP'   => ['type'=>'0x80','val'=>'0'],
        'SL_CT_RGBW' => ['type'=>'0x80','val'=>'0'],
        'SL_DOOYA'   => ['type'=>'0xCE','val'=>'0x80']
    ];

    //区域配置
    public static $regionConf = 
    [
        'kt' => '客厅',
        'cf' => '厨房',
        'sf' => '书房',
        'dm' => '大门'
    ];

 }

/**
 * 智能数据显示
 */
trait SmartDataShow{

    /**
     * 获取所有场景
     * @return [type] [description]
     */
    public static function getSceneAll()
    {
        return DevScene::all();
    }

    /**
     * 获取指定区域的场景
     * @param  [type] $region_name [description]
     * @return [type]              [description]
     */
    public static function getScenesByRegionName($region_name)
    {
        return DevScene::where('region_name',$region_name)->get();
    }

    /**
     * 获取指定模型的设备
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public static function getModelDevices($model)
    {
        $allDevices = [];
       //灯光设备
        if(in_array($model, self::$lightDeviceModel))
        {
            $lights = DevLight::orderBy('created_at','desc')->get();
            if(count($lights))
            {
                foreach ($lights as $key => $light) 
                {
                   $allDevices[] = 
                   [
                        'name'       => $light->name,
                        'model'      => $light->model,
                        'model_name' => self::getModelName($light->model),
                        'class'      => '智能灯光设备',
                        'image'      => $light->image,
                        'me'         => $light->me,
                        'support_switch' =>self::getDeviceWhetherSupportSwitch($light->model),
                        'is_on'     => $light->is_on,
                        'support_idx'=> self::getLightSupportIdx($light),
                        'region_name' => self::getRegionDescByName($light->region_name),
                        'state'      => self::getDeviceState($light),
                        'created_at' => $light->created_at
                   ];
                }
            }
            return $allDevices;
        }

       //燃气设备
       //环境设备
       if(in_array($model, self::$cpDeviceModel) || in_array($model, self::$cqDeviceModel))
       {
            $sensors = DevSensor::orderBy('created_at','desc')->where('model',$model)->get();

            if(count($sensors))
            {
                foreach ($sensors as $key => $sensor) 
                {
                   $allDevices[] = 
                   [
                        'name'       => $sensor->name,
                        'model'      => $sensor->model,
                        'model_name' => self::getModelName($sensor->model),
                        'class'      => '智能传感器设备',
                        'image'      => $sensor->image,
                        'me'         => $sensor->me,
                        'support_switch' => self::getDeviceWhetherSupportSwitch($sensor->model),
                        'is_on'     => 0,
                        'support_idx'=> '',
                        'region_name' => self::getRegionDescByName($sensor->region_name),
                        'state'      => self::getDeviceState($sensor),
                        'created_at' => $sensor->created_at
                   ];
                }
            }
            return $allDevices;
       }

       //窗帘电机
       if(in_array($model, self::$dooyaDeviceModel))
       {
           $dooyas = DevCurtain::orderBy('created_at','desc')->get();

            if(count($dooyas))
            {
                foreach ($dooyas as $key => $dooya) 
                {
                   $allDevices[] = 
                   [
                        'name'       => $dooya->name,
                        'model'      => $dooya->model,
                        'model_name' => self::getModelName($dooya->model),
                        'class'      => '智能窗帘电机设备',
                        'image'      => $dooya->image,
                        'me'         => $dooya->me,
                        'support_switch' => 1,
                        'is_on'     => $dooya->is_on,
                        'support_idx'=> 'P2',
                        'region_name' => self::getRegionDescByName($dooya->region_name),
                        'state'      => self::getDeviceState($dooya),
                        'created_at' => $dooya->created_at
                   ];
                }
            }
            return $allDevices;
       }

       return $allDevices;
    }

    /**
     * 获取所有的设备列表
     * @return [type] [description]
     */
    public static function getAllDevicesAndByRegionName($region_name = null)
    {
        $allDevices = [];

        //智能灯光设备
        $lights = DevLight::orderBy('created_at','desc');

        if($region_name)
        {
            $lights = $lights->where('region_name',$region_name);
        }
            
        $lights = $lights->get();

        if(count($lights))
        {
            foreach ($lights as $key => $light) 
            {
               $allDevices[] = 
               [
                    'name'       => $light->name,
                    'model'      => $light->model,
                    'model_name' => self::getModelName($light->model),
                    'class'      => '智能灯光设备',
                    'image'      => $light->image,
                    'me'         => $light->me,
                    'support_switch' => self::getDeviceWhetherSupportSwitch($light->model),
                    'is_on'     => $light->is_on,
                    'support_idx'=> self::getLightSupportIdx($light),
                    'region_name' => self::getRegionDescByName($light->region_name),
                    'state'      => self::getDeviceState($light),
                    'created_at' => $light->created_at
               ];
            }
        }

        //智能传感器设备
        $sensors = DevSensor::orderBy('created_at','desc');

        if($region_name)
        {
            $sensors = $sensors->where('region_name',$region_name);
        }

        $sensors = $sensors->get();

        if(count($sensors))
        {
            foreach ($sensors as $key => $sensor) 
            {
               $allDevices[] = 
               [
                    'name'       => $sensor->name,
                    'model'      => $sensor->model,
                    'model_name' => self::getModelName($sensor->model),
                    'class'      => '智能传感器设备',
                    'image'      => $sensor->image,
                    'me'         => $sensor->me,
                    'support_switch' =>self::getDeviceWhetherSupportSwitch($sensor->model),
                    'is_on'     => 0,
                    'support_idx'=> '',
                    'region_name' => self::getRegionDescByName($sensor->region_name),
                    'state'      => self::getDeviceState($sensor),
                    'created_at' => $sensor->created_at
               ];
            }
        }

        $dooyas = DevCurtain::orderBy('created_at','desc');

        if($region_name)
        {
            $dooyas = $dooyas->where('region_name',$region_name);
        }

        $dooyas = $dooyas->get();
        if(count($dooyas))
        {
            foreach ($dooyas as $key => $dooya) 
            {
               $allDevices[] = 
               [
                    'name'       => $dooya->name,
                    'model'      => $dooya->model,
                    'model_name' => self::getModelName($dooya->model),
                    'class'      => '智能窗帘电机设备',
                    'image'      => $dooya->image,
                    'me'         => $dooya->me,
                    'support_switch' => 1,
                    'is_on'     => $dooya->is_on,
                    'support_idx'=> 'P2',
                    'region_name' => self::getRegionDescByName($dooya->region_name),
                    'state'      => self::getDeviceState($dooya),
                    'created_at' => $dooya->created_at
               ];
            }
        }

        return $allDevices;
    }

    /**
     * 用于可添加的设备列表
     * @return [type] [description]
     */
    public static function getCanUseDevices($scene_id = null)
    {
        $canUseDevices = [];

        $scene = null;

        //智能灯光设备
        $lights = DevLight::where('state',1);


        if($scene_id)
        {
            $scene = DevScene::find($scene_id);

            if(!empty($scene))
            {
                $lights = $lights->where('region_id',$scene->region_id);
            }
        }

        $lights = $lights
        ->where('agt_state',1)
        ->get();

        if(count($lights))
        {
            foreach ($lights as $key => $light) 
            {
               $canUseDevices[] = 
               [
                    'name'       => $light->name.'(me:'.$light->me.')'.'[智能灯光设备]',
                    'me'         => $light->me,
                    'supportIdx' => self::getLightSupportIdx($light)
               ];
            }
        }

        //燃气设备
        $DevSensors = DevSensor::where('type',2)->where('state',1);

        if(!empty($scene))
        {
            $DevSensors = $DevSensors->where('region_id',$scene->region_id);
        }

         $DevSensors = $DevSensors
        ->where('agt_state',1)
        ->get();

        if(count($DevSensors))
        {
            foreach ($DevSensors as $key => $light) 
            {
               $canUseDevices[] = 
               [
                    'name'       => $light->name.'(me:'.$light->me.')'.'[智能燃气传感器]',
                    'me'         => $light->me,
                    'supportIdx' => 'P3'
               ];
            }
        }
        
        /**
         * 智能窗帘电机
         * @var [type]
         */
        $DevCurtains = DevCurtain::where('state',1);

        if(!empty($scene))
        {
            $DevCurtains = $DevCurtains->where('region_id',$scene->region_id);
        }

         $DevCurtains = $DevCurtains
        ->where('agt_state',1)
        ->get();

        if(count($DevCurtains))
        {
            foreach ($DevCurtains as $key => $light) 
            {
               $canUseDevices[] = 
               [
                    'name'       => $light->name.'(me:'.$light->me.')'.'[智能窗帘电机]',
                    'me'         => $light->me,
                    'supportIdx' => 'P2'
               ];
            }
        }

        return $canUseDevices;
    }

}

/**
 * 智能数据缓存服务
 */
trait SmartCacheService{
    /**
     * 获取缓存的智慧中心agt
     * @return [type] [description]
     */
    public static function getCacheAgt()
    {
        return SmartCache::remember('smart_agt',SmartConfig::get('smart.agt_cache_time'),function(){
            return getSettingValueByKey('agt');
        });
    }

     //java server请求地址
    public static function smartRequestUrl()
    {
        return SmartCache::remember('smart_java_request',SmartConfig::get('smart.java_request_time'),function(){
            return getSettingValueByKey('java_request_url') ?  : self::$javaRequestUrl;
        });
    }
}

/**
 * 智能控制
 */
trait SmartControl{
    /**
     * 更新设备状态
     * @param  [type] $input [description]
     * @return [type]        [description]
     */
    public static function updateDeviceStatus($input,$switch)
    {
        $light = DevLight::where('me',$input['me'])->first();
        if(!empty($light))
        {
            $light->update(['is_on'=>(int)$switch]);
        }
    }


    /**
     * 打开关闭场景
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function swithScene($scene_id,$switch)
    {
        $scene = app('common')->DevSceneRepo()->findWithoutFail($scene_id);

        if(empty($scene))
        {
            return zcjy_callback_data('没有该场景',1);
        }

        $action = 0;

        if($switch && (int)$switch === 1)
        {
            $action = 1;

        }
        //设置场景
        app('common')->DevSceneRepo()->setSceneSwitch($action,$scene,true);
        return zcjy_callback_data('操作成功');
    }

    /**
     * 添加新设备
     * @param [type] $request [description]
     */
    public static function addDeviceRequest()
    {
        $input = ['agt'=>self::getCacheAgt()];
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'add_device','GET',$input);
        return self::returnVarifyJavaResultData($result);
    }

    /**
     * 单个设备控制请求
     * @param [type] $request [description]
     */
    public static function ControlRequest($request)
    {
        $input = $request->all();

        if(!isset($input['me']))
        {
            return zcjy_callback_data('缺少me参数',1);
        }

        if(!isset($input['model']))
        {
            return zcjy_callback_data('缺少model参数',1);
        }

        if(!self::getDeviceWhetherSupportSwitch($input['model']))
        {
            return zcjy_callback_data('当前设备型号不支持控制',1);
        }

        $switch = 0;
        $controlParam = self::$controlCloseParam;

        if(isset($input['switch']) && (int)$input['switch'] === 1)
        {
            $switch = 1;
            $controlParam = self::$controlOpenParam;
        }

        $input['idx'] = self::$controlIdx[$input['model']];

        $input['type'] = $controlParam[$input['model']]['type'];

        $input['val'] = $controlParam[$input['model']]['val'];

        $input['agt'] = self::getCacheAgt();
        // return $input;
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'set_one_device','GET',$input);

        self::updateDeviceStatus($input,$switch);
        
        return self::returnVarifyJavaResultData($result);
    }

    /**
     * 多个设备控制请求
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public static function mutiControlRequest($params)
    {
        if(empty($params))
        {
            return zcjy_callback_data('缺少控制参数',1);
        }
        $params = ['args'=>$params];
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'set_multi_devices','POST',$params);
        return self::returnVarifyJavaResultData($result);
    }

}

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