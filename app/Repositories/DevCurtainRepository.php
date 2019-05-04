<?php

namespace App\Repositories;

use App\Models\DevCurtain;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevCurtainRepository
 * @package App\Repositories
 * @version May 4, 2019, 5:15 pm CST
 *
 * @method DevCurtain findWithoutFail($id, $columns = ['*'])
 * @method DevCurtain find($id, $columns = ['*'])
 * @method DevCurtain first($columns = ['*'])
*/
class DevCurtainRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'me',
        'model',
        'name',
        'state',
        'motion_type',
        'percent',
        'agt',
        'agt_state',
        'region_id',
        'is_join',
        'join_at',
        'idx'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevCurtain::class;
    }
}
