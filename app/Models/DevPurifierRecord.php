<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevPurifierRecord
 * @package App\Models
 * @version April 26, 2019, 11:56 am CST
 *
 */
class DevPurifierRecord extends Model
{
    // use SoftDeletes;

    public $table = 'dev_purifier_record';
    const UPDATED_AT = null;
    const DELETED_AT = null;
    //const CREATED_AT = null;

    // protected $dates = ['deleted_at'];


    public $fillable = [
      'temp',// float(10, 2) NULL DEFAULT NULL COMMENT '温度',
      'hum',// float(10, 2) NULL DEFAULT NULL COMMENT '湿度',
      'pm2_5',// float(10, 2) NULL DEFAULT NULL COMMENT 'pm2.5浓度',
      'age',// float(10, 2) UNSIGNED NULL DEFAULT 1.00 COMMENT '使用寿命 单位 小时',
      'ray',// float(10, 2) NULL DEFAULT NULL COMMENT '紫外线指数',
      'purifier_id',// bigint(20) NOT NULL COMMENT '净化器ID',
    ];

    private static $attribute = [
      'temp' => '',// float(10, 2) NULL DEFAULT NULL COMMENT '温度',
      'hum'  => '',// float(10, 2) NULL DEFAULT NULL COMMENT '湿度',
      'pm2_5'=> '',// float(10, 2) NULL DEFAULT NULL COMMENT 'pm2.5浓度',
      'age'  => '', //,// float(10, 2) UNSIGNED NULL DEFAULT 1.00 COMMENT '使用寿命 单位 小时',
      'ray'  => '',// float(10, 2) NULL DEFAULT NULL COMMENT '紫外线指数',
      'purifier_id' => 1,// bigint(20) NOT NULL COMMENT '净化器ID',
    ];
    
    //温度      0-40
    //环境湿度  0-100  
    //紫外线 0-11 >=11    
    //净化器id  1
    
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
     * 获取传感器的数据
     * @return [type] [description]
     */
    public static function getRecord()
    {
        $attribute = self::$attribute;
        #温度
        $attribute['temp'] = rand(20,22);
        #环境湿度
        $attribute['hum'] = rand(50,55);
        #pm2.5
        $attribute['pm2_5'] = rand(100,125);
        #使用寿命
        $attribute['age'] = dealFloatData(4799.12);
        #ray
        $attribute['ray'] = rand(4,5);
        return $attribute;
    }

}
