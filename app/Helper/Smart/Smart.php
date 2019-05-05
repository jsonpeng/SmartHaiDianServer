<?php

use Cache as SmartCache;
use Config as SmartConfig;

//引入数据显示Trait
if (is_file(__DIR__ . '/Trait/SmartDataShow.php')) {
    require_once __DIR__ . '/Trait/SmartDataShow.php';
}

//引入控制Trait
if (is_file(__DIR__ . '/Trait/SmartControl.php')) {
    require_once __DIR__ . '/Trait/SmartControl.php';
}

//引入帮助Helper Trait
if (is_file(__DIR__ . '/Trait/SmartHelper.php')) {
    require_once __DIR__ . '/Trait/SmartHelper.php';
}


class Smart{
     //引入外链trait
     use SmartDataShow,SmartControl,SmartHelper;
     //引入本文件中缓存服务及常量管理
     use SmartCacheService,SmartContent;
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


