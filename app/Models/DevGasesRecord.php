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
class DevGasesRecord extends Model
{
    // use SoftDeletes;

    public $table = 'dev_gases_record';
    const UPDATED_AT = null;
    const DELETED_AT = null;
    //const CREATED_AT = null;

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'conc', //float NULL DEFAULT NULL COMMENT '燃气浓度',
        'sensor_id',// bigint(20) NOT NULL COMMENT '传感器ID',
        'sensor_type', //smallint(6) NOT NULL COMMENT '传感器类型',
    ];

    private static $attribute = [
        'conc'=>'',//float NULL DEFAULT NULL COMMENT '燃气浓度',
        'sensor_id'=>'',// bigint(20) NOT NULL COMMENT '传感器ID',
        'sensor_type'=>'',//smallint(6) NOT NULL COMMENT '传感器类型',
    ];
      //燃气参考指标
      // 低灵敏度：val=150;
      // 中灵敏度： val=120; 
      // ⾼灵敏度： val=90; 
      
      // 甲醛参考指标
      // 甲醛浓度安全区间为:
      // [0,0.086]mg/m3 也即:
      // [0,86]ug/m3；
      // 不告警：val=5000;
      // 中灵敏： val=100; 
      // ⾼灵敏： val=80;
      
      //sensor id 标示
      //5=>甲醛
      //4=>燃气
      

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
    public static function getSensor()
    {
        $data = [];
        #插入甲醛气体数据
        $data[] = DevGasesRecord::getCP();
        #插入燃气气体数据
        $data[] = DevGasesRecord::getCH();
        return $data;
    }

    /**
     * 获取甲醛 
     * @return [type] [description]
     */
    public static function getCP()
    {
        $attribute = self::$attribute;
        $attribute['sensor_type'] = 1;
        #起始甲醛浓度 50
        $attribute['conc'] = rand(50,56);
        $attribute['sensor_id'] = 5;
        return $attribute;
    }

    /**
     * 获取燃气
     * @return [type] [description]
     */
    public static function getCH()
    {
        $attribute = self::$attribute;
        $attribute['sensor_type'] = 2;
        $attribute['conc'] = rand(80,160);
        $attribute['sensor_id'] = 4;
        return $attribute;
    }

    
}
