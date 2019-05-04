<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevCurtain
 * @package App\Models
 * @version May 4, 2019, 5:15 pm CST
 *
 * @property string me
 * @property string model
 * @property string name
 * @property integer state
 * @property integer motion_type
 * @property integer percent
 * @property string agt
 * @property integer agt_state
 * @property integer region_id
 * @property integer is_join
 * @property string join_at
 * @property string idx
 */
class DevCurtain extends Model
{
    // use SoftDeletes;

    public $table = 'dev_curtain';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'me',
        'model',
        'name',
        'state',
        'motion_type',
        'percent',
        'agt',
        'agt_state',
        'region_id',
        'region_name',
        'is_join',
        'join_at',
        'idx',
        'is_on'
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
        'motion_type' => 'integer',
        'percent' => 'integer',
        'agt' => 'string',
        'agt_state' => 'integer',
        'region_id' => 'integer',
        'is_join' => 'integer',
        'join_at' => 'string',
        'idx' => 'string'
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
        'state' => 'required',
        'idx' => 'required',
        'agt' => 'required',
    ];

    
}
