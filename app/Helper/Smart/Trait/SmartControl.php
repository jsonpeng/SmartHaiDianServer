<?php
use App\Models\DevLight;
use App\Models\DevSensor;
use App\Models\DevScene;
use App\Models\DevCurtain;

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
        $switch = (int)$switch;
        //灯光
        $light = DevLight::where('me',$input['me'])->first();
        if(!empty($light))
        {
            $light->update(['is_on'=>$switch]);
            return;
        }

        //燃气感应器
        $sensor = DevSensor::where('me',$input['me'])->first();
        if(!empty($sensor))
        {
            $sensor->update(['alarm_sound'=>$switch]);
        }

        //窗帘
        $doorya = DevCurtain::where('me',$input['me'])->first();
        if(!empty($doorya))
        {
            $doorya->update(['is_on'=>$switch]);
            return;
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

        //更新DB
        // self::updateDeviceStatus($input,$switch);
        
        return self::returnVarifyJavaResultData($result);
    }


    /**
     * 控制灯光请求
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function controlLightRequest($request)
    {
        $input = $request->all();

        if(!isset($input['me']))
        {
            return zcjy_callback_data('缺少me参数',1);
        }

        if(!isset($input['color']))
        {
            return zcjy_callback_data('缺少color参数',1);
        }

        $input['idx'] = 'RGBW';

        if((int)$input['color'] === 0 && strlen($input['color']) == 1)
        {
            $input['type'] = '0x80';
            $input['val'] = '0';
        }
        else{
            $input['type'] = '0xff';
            // $colorArr = [
            //         '1' => '16734720',  //橙色
            //         '2' => '16720896',  //红色
            //         '3' => '16755200',  //黄色
            //         '4' => '16711760',  //紫色
            //         '5' => '1376000',   //绿色
            //         '6' => '65520',     //蓝色
            //         '7' => '4278196580' //白色
            // ];
            $input['val'] = $input['color'];
        }

        $input['agt'] = self::getCacheAgt();
     
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'set_one_device','GET',$input);
        
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

    /**
     * 获取所有的真实设备
     * @return [type] [description]
     */
    public static function getAllCurrentDevices()
    {
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'get_all_devices','GET');
        $result = json_decode($result,1);
        $allDevices = [];
        if(isset($result['code']) && (int)$result['code'] === 0)
        {
            $devices = $result['data'];
            //只取stat是1 并且 agt是当前DB存的
            foreach ($devices as $key => $device) 
            {
                $device['data_encode'] = json_encode($device['data']);
                //(int)$device['stat'] === 1 &&
               
                if($device['agt'] != self::getCacheAgt())
                {
                    $device['agt_status'] = '不在线';
                }
                else{
                    $device['agt_status'] = '在线';
                }

                $allDevices[] = $device;
            }
        }
        return $allDevices;
    }

    /**
     * 更新所有设备的状态
     * @return [type] [description]
     */
    public static function updateAllDeviceStatus()
    {
       $allDevices = self::getAllCurrentDevices();
       return $allDevices;
    }


    /**
     * 获取门锁所有得临时用户
     * @return [type] [description]
     */
    public static function getAllTempDoorUser()
    {
        $requestParam = [
            'agt' => self::getCacheAgt(),
            'me'  => self::getCacheDoorMe()
        ];  
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'get_door_set_users','GET',$requestParam);
        $result = json_decode($result,1);
        $allUsers = [];
        if(isset($result['code']) && (int)$result['code'] === 0)
        {
            $users = $result['data'];
            
            //只取stat是1 并且 agt是当前DB存的
            foreach ($users as $key => $user) 
            {
              if($user['ty'] == 'R')
              {
                $allUsers[] = $user;
              }
            }
        }
        return $allUsers;
    }

    /**
     * 设置门锁临时用户
     * @param string $action [description]
     * @param [type] $input  [description]
     * @param [type] $id     [description]
     */
    public static function setTempDoorUser($action = "create",$user)
    {   
        $requestParam = [];

        if(!in_array($action, ['create','modify','delete']))
        {
            return;
        }
      
        $requestParam['name'] = $user->name;
        $requestParam['pwd'] = $user->pwd;
        $requestParam['agt'] = self::getCacheAgt();
        $requestParam['me'] = self::getCacheDoorMe();
        $requestParam['oper'] = $action;

        //编辑得话直接是自己得
        if($action == 'modify' || $action == 'delete')
        {
           
                $requestParam['sn'] = $user->sn;
        }#添加序号累加
        else{
                $requestParam['sn'] = count(self::getAllTempDoorUser()) + 1;
                $user->update(['sn'=>$requestParam['sn']]);
        }

        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'set_temp_door','GET',$requestParam);
        return self::returnVarifyJavaResultData($result);
    }


}