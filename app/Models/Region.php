<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Region
 * @package App\Models
 * @version May 1, 2019, 10:32 am CST
 *
 * @property string name
 * @property string desc
 */
class Region extends Model
{
    // use SoftDeletes;

    public $table = 'regions';
    
    const UPDATED_AT = null;
    const DELETED_AT = null;
    // protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'desc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'desc' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'desc' => 'required'
    ];

    
}
