<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ChartData
 * @package App\Models
 * @version May 9, 2019, 1:56 pm CST
 *
 * @property string idx
 * @property string desc
 * @property string val
 * @property integer time_span
 * @property string record_date
 * @property string record_time
 */
class ChartData extends Model
{
    // use SoftDeletes;

    public $table = 'chart_data';
    
    const UPDATED_AT = null;
    const DELETED_AT = null;
    const CREATED_AT = null;
    // protected $dates = ['deleted_at'];


    public $fillable = [
        'idx',
        'desc',
        'val',
        'time_span',
        'record_date',
        'record_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idx' => 'string',
        'desc' => 'string',
        'val' => 'string',
        'time_span' => 'integer',
        'record_date' => 'string',
        'record_time' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idx' => 'required',
        'val' => 'required',
        'time_span' => 'required',
    ];

    //指标类型
    public $chartIdx = [
        'water' => '用水量',
        'elec'  => '用电量',
        'gas'   => '天然气量',
        'cf_elec' => '厨房用电量',
        'kt_elec' => '客厅用电量',
        'sf_elec' => '书房用电量',
        'jk_elec' => '监控中心',
        'online_total' => '设备总数',
        'send_total'   => '发送请求数',
        'receive_total' => '接受请求数',
        'csld'          => '厂商联动',
        'sfld'          => '三方联动',
        'fault_rate'    => '设备故障'  
    ];
    //时间跨度
    public $timeSpan = [
        '0' => '小时',
        '1' => '按天',
        '2' => '按月'
    ];

    public function getIdxNameAttribute()
    {
        return isset($this->chartIdx[$this->idx]) ? $this->chartIdx[$this->idx] : '未知';
    }

    public function getTimeNameAttribute()
    {
        return isset($this->timeSpan[$this->time_span]) ? $this->timeSpan[$this->time_span] : '未知';
    }

    public function getTimeCurrentAttribute()
    {
        $time = $this->record_date;

        if(!empty($this->record_time))
        {
            $time = $this->record_time;
        }
        return $time;
    }

    
}
