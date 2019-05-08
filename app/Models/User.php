<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version May 7, 2019, 6:28 pm CST
 *
 * @property string uuid
 * @property string name
 * @property string pwd
 * @property string welcome_sound_url
 * @property string mobile
 * @property integer sex
 * @property string welcome
 */
class User extends Model
{
    // use SoftDeletes;

    public $table = 'users';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'name',
        'pwd',
        'welcome_sound_url',
        'mobile',
        'sex',
        'welcome',
        'sn'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'pwd' => 'string',
        'welcome_sound_url' => 'string',
        'mobile' => 'string',
        'sex' => 'integer',
        'welcome' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'pwd' => 'required|min:6|unique:users',
        'welcome' => 'required'
    ];

    
}
