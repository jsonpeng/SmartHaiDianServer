<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Preference
 * @package App\Models
 * @version May 8, 2019, 2:40 pm CST
 *
 * @property integer user_id
 * @property integer scene_id
 */
class Preference extends Model
{
    // use SoftDeletes;

    public $table = 'preference';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'scene_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
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
