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
    const CREATED_AT = null;

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'elecollector_uuid',
        'mac',
        'sn',
        'elemeter_type',
        'version',
        'onoff_line',
        'onoff_time',
        'bind_time',
        'name',
        'model',
        'model_name',
        'brand',
        'operation',
        'operation_stage',
        'charger_stage',
        'overdraft_stage',
        'capacity_stage',
        'trans_status',
        'trans_status_time'
    ];

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

    
}
