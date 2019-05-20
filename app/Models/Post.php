<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cat;

/**
 * Class Post
 * @package App\Models
 * @version May 19, 2019, 12:52 pm CST
 *
 * @property string name
 * @property string des
 * @property string image
 * @property string content
 * @property string video_url
 */
class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'des',
        'image',
        'content',
        'video_url',
        'cat_slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'des' => 'string',
        'image' => 'string',
        'content' => 'string',
        'video_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'    => 'required',
        'content' => 'required'
    ];

    public function getCatNameAttribute()
    {
        $cat = Cat::where('slug',$this->cat_slug)->first();
        return optional($cat)->name;
    }

    
}
