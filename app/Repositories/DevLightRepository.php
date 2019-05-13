<?php

namespace App\Repositories;

use App\Models\DevLight;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevLightRepository
 * @package App\Repositories
 * @version May 1, 2019, 9:56 am CST
 *
 * @method DevLight findWithoutFail($id, $columns = ['*'])
 * @method DevLight find($id, $columns = ['*'])
 * @method DevLight first($columns = ['*'])
*/
class DevLightRepository extends BaseRepository
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
        'region_id',
        'is_on',
        'rgbw',
        'dyn',
        'color_temp',
        'bri',
        'agt',
        'agt_state',
        'agt_state',
        'is_join',
        'join_at',
        'icon'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevLight::class;
    }
}
