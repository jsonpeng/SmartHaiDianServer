<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevDoorLock
 * @package App\Models
 * @version May 7, 2019, 6:00 pm CST
 *
 * @property string me
 * @property string model
 * @property string name
 * @property integer state
 * @property string battery
 * @property integer region_id
 * @property string region_name
 * @property string agt
 * @property integer agt_state
 * @property integer is_join
 * @property string join_at
 */
class DevDoorLock extends Model
{
    // use SoftDeletes;

    public $table = 'dev_door_lock';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'me',
        'model',
        'name',
        'state',
        'battery',
        'region_id',
        'region_name',
        'agt',
        'agt_state',
        'is_join',
        'join_at',
        'image'
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
        'battery' => 'string',
        'region_id' => 'integer',
        'region_name' => 'string',
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
