<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DevScene
 * @package App\Models
 * @version May 1, 2019, 10:44 am CST
 *
 * @property string name
 * @property string description
 * @property integer enabled
 * @property integer region_id
 */
class DevScene extends Model
{
    // use SoftDeletes;

    public $table = 'dev_scene';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'enabled',
        'region_id',
        'image',
        'region_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'enabled' => 'integer',
        'region_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function getEnabledStatusAttribute()
    {
        return $this->enabled ? '<span class="btn btn-success btn-xs" onclick="formSubmit(this)">开启</span>' : '<span class="btn btn-danger btn-xs" onclick="formSubmit(this)">关闭</span>';
    }
    
}
