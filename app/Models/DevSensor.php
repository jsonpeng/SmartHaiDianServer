<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevSensor
 * @package App\Models
 * @version May 2, 2019, 12:12 am CST
 *
 * @property string me
 * @property string model
 * @property string name
 * @property integer state
 * @property integer type
 * @property string threshold
 * @property integer alarm_sound
 * @property integer region_id
 * @property string agt
 * @property integer agt_state
 * @property integer is_join
 * @property string join_at
 */
class DevSensor extends Model
{
    // use SoftDeletes;

    public $table = 'dev_sensor';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'me',
        'model',
        'name',
        'state',
        'type',
        'threshold',
        'alarm_sound',
        'region_id',
        'agt',
        'agt_state',
        'is_join',
        'join_at',
        'region_name',
        'image',
        'idx',
        'icon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'me' => 'string',
        'model' => 'string',
        'name' => 'string',
        'state' => 'integer',
        'type' => 'integer',
        'threshold' => 'string',
        'alarm_sound' => 'integer',
        'region_id' => 'integer',
        'agt' => 'string',
        'agt_state' => 'integer',
        'is_join' => 'integer',
        'join_at' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
         'me' => 'required',
        'model' => 'required',
        'name' => 'required',
        'agt' => 'required',
    ];

    
}
