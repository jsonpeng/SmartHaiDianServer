<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevIdxDay
 * @package App\Models
 * @version May 8, 2019, 4:36 pm CST
 *
 * @property string idx
 * @property string val
 * @property string record_at
 */
class DevIdxDay extends Model
{
    // use SoftDeletes;

    public $table = 'dev_idx_day';
    
    const UPDATED_AT = null;
    // const DELETED_AT = null;
    const CREATED_AT = null;
    // const CREATED_AT = 'create_at';
    // protected $dates = ['deleted_at'];


    public $fillable = [
        'idx',
        'val',
        'record_at'
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
        'idx' => 'required',
        'val' => 'required',
        'record_at' => 'required'
    ];

    
}
