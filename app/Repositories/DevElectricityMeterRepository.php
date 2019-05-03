<?php

namespace App\Repositories;

use App\Models\DevElectricityMeter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevElectricityMeterRepository
 * @package App\Repositories
 * @version April 26, 2019, 11:56 am CST
 *
 * @method DevElectricityMeter findWithoutFail($id, $columns = ['*'])
 * @method DevElectricityMeter find($id, $columns = ['*'])
 * @method DevElectricityMeter first($columns = ['*'])
*/
class DevElectricityMeterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'elecollector_uuid',
        'mac',
        'sn',
        'elemeter_type',
        'version',
        'onoff_line',
        'onoff_time',
        'bind_time',
        'name',
        'model',
        'model_name',
        'brand',
        'operation',
        'operation_stage',
        'charger_stage',
        'overdraft_stage',
        'capacity_stage',
        'trans_status',
        'trans_status_time'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevElectricityMeter::class;
    }
}
