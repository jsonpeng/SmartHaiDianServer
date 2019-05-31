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
class DevElectricityMeter extends Model
{
    // use SoftDeletes;

    public $table = 'dev_electricity_meter';
    const UPDATED_AT = null;
    const DELETED_AT = null;
    // const CREATED_AT = null;
    // protected $dates = ['deleted_at'];

    public $fillable = [
        'uuid',
        'mac',
        'sn',
        'onoff_line',
        'bind_time',
        'name',
        'model',//设备类型
        'model_name',//设备型号名称
        'brand',//品牌
        'trans_status',
        'enable_state',
        'power_total',
        'capacity',//额定功率
        'consume_amount',//电表当前电量
        'region_id',
        'region_name'
    ];


      // `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
      // `uuid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '电表uuid',
      // `mac` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '设备MAC地址',
      // `sn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '设备序列号',
      // `onoff_line` smallint(6) NOT NULL COMMENT '电表状态',
      // `bind_time` int(11) NULL DEFAULT NULL COMMENT '设备注册时间时间戳',
      // `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '电表名字',
      // `model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '设备类型',
      // `model_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '设备型号名称',
      // `brand` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '品牌',
      // `trans_status` tinyint(4) NULL DEFAULT NULL,
      // `enable_state` tinyint(4) NULL DEFAULT NULL,
      // `power_total` decimal(10, 2) NULL DEFAULT NULL,
      // `capacity` decimal(10, 2) NULL DEFAULT NULL COMMENT '额定功率',
      // `consume_amount` decimal(10, 2) NULL DEFAULT NULL COMMENT '电表当前电量',
      // `region_id` bigint(20) NULL DEFAULT NULL,
      // `region_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '区域名称',
    
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
        'uuid' => 'required',
        'mac' => 'required',
        'sn' => 'required',
        'onoff_line' => 'required',
        'name' => 'required',
        'capacity' => 'required',
        'consume_amount' => 'required'
    ];

    
}
