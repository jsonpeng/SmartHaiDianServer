<?php
use App\Models\DevLight;
use App\Models\DevSensor;
use App\Models\DevScene;
use App\Models\DevLfScene;
use App\Models\DevCurtain;
use App\Models\DevCommand;
//用户偏好
use App\Models\Preference;

/**
 * 智能控制
 */
trait SmartControl{

    /**
     * 关闭所有场景及设备
     * @return [type] [description]
     */
    public static function closeAllSceneAndDev()
    {
        $switch =self::getCacheSceneSwitch();
        //默认自定义场景
        if($switch === 1)
        {
            DevScene::orderBy('id','asc')->update(['enabled'=>0]);

            $lights = DevLight::orderBy('region_id','asc')
            ->where('state',1)
            ->where('is_on',1)
            ->select('me','idx','agt')
            ->get();

            $commandDatas = collect([]);

            if(count($lights))
            {
                foreach ($lights as $key => $light) 
                {
                  $light['type'] = '0x80';
                  $light['val'] = '0';
                }

                $commandDatas = $commandDatas->concat($lights);

                //窗帘电机
                $curtains = DevCurtain::orderBy('region_id','asc')
                ->where('state',1)
                ->select('me','idx','agt')
                ->get();

                if(count($curtains))
                {
                    foreach ($curtains as $key => $curtain) 
                    {
                      $curtain['type'] = '0xCE';
                      $curtain['val'] = '0x80';
                    }
                    $commandDatas = $commandDatas->concat($curtains);
                }
            }

            if(count($commandDatas))
            {
                 $commandDatas = json_encode($commandDatas);
                 //发起请求
                 self::mutiControlRequest($commandDatas);
            }

        }
        else{
            DevLfScene::orderBy('id','asc')->update(['enabled'=>0]);
            $scene = DevLfScene::where('name','全关')->first();
            if(!empty($scene))
            {
                self::setLfScene($scene);
            }
        }

    }


    /**
     * 触发用户多个场景
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public static function triggerUserMutiScenes($user_id)
    {
        $scenes = Preference::where('user_id',$user_id)->get();

        if(count($scenes))
        {
         
            $sceneIdArr = [];

            foreach ($scenes as $key => $scene) 
            {
                $sceneIdArr[] = $scene->scene_id;
            }

            $switch = \Smart::getCacheSceneSwitch();
            if($switch === 1)
            {
                $commandDatas = DevCommand::whereIn('scene_id',$sceneIdArr)
                ->select('me','idx','type','val','agt')
                ->get();

                if(count($commandDatas))
                {
                    $commandDatas = json_encode($commandDatas);
                    // Log::info('开启场景命令:'.$commandDatas);
                    //发起请求
                    self::mutiControlRequest($commandDatas);
                }

            }
            else{
                $scenes = DevScene::whereIn('id',$sceneIdArr)->get();
                // \Log::info($sceneIdArr);
                foreach ($scenes as $key => $scene) {
                    self::setLfScene($scene);
                }
            }

        }
    }

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


    public static function setLfScene($scene)
    {
        if(empty($scene))
        {
            return;
        }

        if(empty($scene->me))
        {
            return;
        }
        $params = ['agt'=>self::getCacheAgt(),'me'=>$scene->me];
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'do_scene','GET',$params);
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
     * 获取所有的网关列表
     * @return [type] [description]
     */
    public static function getAllGatewaies()
    {
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'get_all_agts','GET');
        $result = json_decode($result,1);
        $allGatewaies = [];
        if(isset($result['code']) && (int)$result['code'] === 0)
        {
            $gatewaies = $result['data'];
            //只取stat是1 并且 agt是当前DB存的
            foreach ($gatewaies as $key => $gatewaie) 
            {
                if((int)$gatewaie['stat'] === 0)
                {
                    $gatewaie['stat_status'] = '不在线';
                }
                else{
                    $gatewaie['stat_status'] = '在线';
                }

                $allGatewaies[] = $gatewaie;
            }
        }
        return $allGatewaies;
    }


    /**
     * 获取所有的lifesmart场景列表
     * @return [type] [description]
     */
    public static function getAllLfScenes($agt = null)
    {
        if(empty($agt))
        {
            $agt = self::getCacheAgt();
        }
        $params = ['agt'=>$agt];
        $result = self::simpleGuzzleRequest(self::smartRequestUrl().'get_scenes','GET',$params);
        $result = json_decode($result,1);
        $allscenes = [];
        if(isset($result['code']) && (int)$result['code'] === 0)
        {
            $scenes = $result['data'];
            //只取stat是1 并且 agt是当前DB存的
            foreach ($scenes as $key => $scene) 
            {
              
                $allscenes[] = $scene;
            }
        }
        return $allscenes;
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