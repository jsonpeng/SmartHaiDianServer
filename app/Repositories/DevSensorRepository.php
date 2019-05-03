<?php

namespace App\Repositories;

use App\Models\DevSensor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevSensorRepository
 * @package App\Repositories
 * @version May 2, 2019, 12:12 am CST
 *
 * @method DevSensor findWithoutFail($id, $columns = ['*'])
 * @method DevSensor find($id, $columns = ['*'])
 * @method DevSensor first($columns = ['*'])
*/
class DevSensorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'me',
        'model',
        'name',
        'state',
        'type',
        'threshold',
        'alarm_sound',
        'region_id',
        'agt',
        'agt_state',
        'is_join',
        'join_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevSensor::class;
    }
}
