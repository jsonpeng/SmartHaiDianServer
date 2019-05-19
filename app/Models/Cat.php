<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cat
 * @package App\Models
 * @version May 19, 2019, 12:44 pm CST
 *
 * @property string name
 */
class Cat extends Model
{
    use SoftDeletes;

    public $table = 'cats';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'slug' => 'required'
    ];

    
}
