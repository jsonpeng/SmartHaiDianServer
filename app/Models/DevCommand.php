<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevCommand
 * @package App\Models
 * @version May 1, 2019, 10:57 am CST
 *
 * @property string me
 * @property string idx
 * @property string type
 * @property string val
 * @property string tag
 * @property string agt
 * @property integer scene_id
 */
class DevCommand extends Model
{
    // use SoftDeletes;

    public $table = 'dev_commands';
    const UPDATED_AT = null;
    const DELETED_AT = null;

    // protected $dates = ['deleted_at'];

    //设备支持的类型
    public static $idx = [
        'RGB' => 'RGB',
        'DYN' => 'DYN',
        'RGBW'=> 'RGBW',
        'P2'  => 'P2',
        'P3'  => 'P3'
    ];

    //设备支持的type
    public static $type = [
        '0x80' => '0x80',
        '0x81' => '0x81',
        '0xff' => '0xff',
        '0xfe' => '0xfe',
        '0xCE' => '0xCE',
        '0xCF' => '0xCF'
    ];

    public $fillable = [
        'me',
        'idx',
        'type',
        'val',
        'tag',
        'agt',
        'scene_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'me' => 'string',
        'idx' => 'string',
        'type' => 'string',
        'val' => 'string',
        'tag' => 'string',
        'agt' => 'string',
        'scene_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
