<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevLight
 * @package App\Models
 * @version May 1, 2019, 9:56 am CST
 *
 * @property string me
 * @property string model
 * @property string name
 * @property integer state
 * @property integer type
 * @property integer region_id
 * @property integer is_on
 * @property string rgbw
 * @property string dyn
 * @property integer color_temp
 * @property integer bri
 * @property string agt
 * @property integer agt_state
 * @property integer agt_state
 * @property integer is_join
 * @property string join_at
 */
class DevLight extends Model
{
    // use SoftDeletes;

    public $table = 'dev_light';
    const UPDATED_AT = null;
    const DELETED_AT = null;
    // protected $dates = ['deleted_at'];


    public $fillable = [
        'me',
        'model',
        'name',
        'state',
        'type',
        'region_id',
        'is_on',
        'rgbw',
        'dyn',
        'color_temp',
        'bri',
        'agt',
        'agt_state',
        'is_join',
        'join_at',
        'region_name',
        'support_rgb',
        'support_rgbw',
        'support_dyn',
        'image',
        'idx',
        'icon'
    ];

    public static $attribute = [
        'me',
        'model',
        'name',
        'state',
        'type',
        'region_id',
        'is_on',
        'rgbw',
        'dyn',
        'color_temp',
        'bri',
        'agt',
        'agt_state',
        'is_join',
        'join_at',
        'region_name',
        'support_rgb',
        'support_rgbw',
        'support_dyn',
        'image',
        'idx'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
      
    ];
 // `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
 //  `me` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '智慧设备唯一ID',
 //  `model` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '型号',
 //  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '名称',
 //  `state` smallint(6) UNSIGNED ZEROFILL NOT NULL DEFAULT 000000 COMMENT '设备状态',
 //  `type` smallint(6) NULL DEFAULT NULL COMMENT '灯光类型',
 //  `region_id` bigint(20) NULL DEFAULT NULL COMMENT '区域id',
 //  `is_on` smallint(6) UNSIGNED ZEROFILL NOT NULL DEFAULT 000000 COMMENT '开关',
 //  `rgbw` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '颜色值',
 //  `dyn` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '动态颜色值',
 //  `color_temp` int(11) NULL DEFAULT NULL COMMENT '色温',
 //  `bri` int(11) NULL DEFAULT NULL COMMENT '亮度',
 //  `agt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '智慧中心ID',
 //  `agt_state` tinyint(4) NULL DEFAULT NULL,
 //  `is_join` smallint(6) UNSIGNED ZEROFILL NOT NULL DEFAULT 000000 COMMENT '是否已接入',
 //  `join_at` timestamp(0) NULL DEFAULT NULL COMMENT '接入时间',
 //  `created_at` timestamp(0) NOT NULL COMMENT '创建时间',
 //  `updated_at` timestamp(0) NULL DEFAULT NULL COMMENT '修改时间',

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'me'   => 'required',
        'name' => 'required',
        'agt'  =>  'required',
        'idx'  => 'required' 
    ];

    //设备状态 1在线0离线
    public function getStateStatusAttribute()
    {
        return $this->state ? '在线' : '离线';
    }

    //开关状态 1开启0关闭
    public function getIsOnStatusAttribute()
    {
        return $this->is_on ? '开启' : '关闭';
    }

    //接入状态 1已接入 0未接入
    public function getIsJoinStatusAttribute()
    {
        return $this->is_join ? '已接入' : '未接入';
    }
    
}
