<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevElectricityMeter
 * @package App\Models
 * @version April 26, 2019, 11:56 am CST
 *
 */
class DevEnvRecord extends Model
{
    // use SoftDeletes;

    public $table = 'dev_env_record';
    const UPDATED_AT = null;
    const DELETED_AT = null;
    //const CREATED_AT = null;

    // protected $dates = ['deleted_at'];


    public $fillable = [
          'temp',// float NULL DEFAULT NULL COMMENT '温度',
          'hum',// float NULL DEFAULT NULL COMMENT '湿度',
          'dioxide',// float NULL DEFAULT NULL COMMENT 'CO2浓度',
          'dioxide_level',// smallint(6) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'CO2浓度评级',
          'tvoc',// float NULL DEFAULT NULL COMMENT 'TVOC浓度',
          'tvoc_level',// smallint(6) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'TVOC浓度评级',
          'sensor_id',// bigint(20) NOT NULL COMMENT '传感器ID',
    ];

    private static $attribute = [
          'temp'=> '',// float NULL DEFAULT NULL COMMENT '温度',
          'hum'=> '',// float NULL DEFAULT NULL COMMENT '湿度',
          'dioxide'=> '',// float NULL DEFAULT NULL COMMENT 'CO2浓度',
          'dioxide_level'=> 1,// smallint(6) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'CO2浓度评级',
          'tvoc'=> '',// float NULL DEFAULT NULL COMMENT 'TVOC浓度',
          'tvoc_level'=> 1,// smallint(6) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'TVOC浓度评级',
          'sensor_id'=> '',// bigint(20) NOT NULL COMMENT '传感器ID',
    ];

    //温度      0-40
    //环境湿度  0-100
    //CO2浓度   0-1000
    //TVOC浓度  0-1000
    //sensor_id 1,2,3
    //3个传感器 温度差+-2 湿度+-5 co2浓度+-10 TVOC浓度

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
      
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * 获取三个环境传感器 的数据
     * @return [type] [description]
     */
    public static function getEnv()
    {
      $attribute_arr = [];
      for ($i=1; $i <=3  ; $i++) 
      { 
        $attribute = self::getOne();
        $attribute['sensor_id'] = $i;
        $attribute_arr[] = $attribute;
      }
      return $attribute_arr;
    }

    /**
     * 生成单个传感器 的数据
     * @return [type] [description]
     */
    public static function getOne()
    {
      $attribute = self::$attribute;
      #温度
      $attribute['temp'] = rand(20,22);
      #环境湿度
      $attribute['hum'] = rand(50,55);
      #CO2浓度
      $attribute['dioxide'] = rand(100,110);
      #tvoc
      $attribute['tvoc'] = rand(150,160);
      return $attribute;
    }



    
}
