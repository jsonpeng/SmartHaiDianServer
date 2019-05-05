<?php
use App\Models\Region;
use App\Models\DevLight;
use App\Models\DevSensor;
use App\Models\DevScene;
use App\Models\DevCurtain;

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
            $lights = DevLight::where('model',$model)->orderBy('created_at','desc')->get();
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