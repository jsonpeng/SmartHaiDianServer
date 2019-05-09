<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GatewayDev
 * @package App\Models
 * @version May 9, 2019, 4:48 pm CST
 *
 * @property string me
 */
class GatewayDev extends Model
{
    use SoftDeletes;

    public $table = 'gateway_devs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'me'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'me' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
