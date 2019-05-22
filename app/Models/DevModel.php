<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevModel
 * @package App\Models
 * @version May 22, 2019, 9:08 pm CST
 *
 * @property string name
 * @property string image
 * @property string model
 */
class DevModel extends Model
{
    use SoftDeletes;

    public $table = 'dev_models';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'model'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'  => 'string',
        'image' => 'string',
        'model' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required',
        'model' => 'required'
    ];

    
}
