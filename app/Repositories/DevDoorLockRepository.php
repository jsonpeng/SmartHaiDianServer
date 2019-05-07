<?php

namespace App\Repositories;

use App\Models\DevDoorLock;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevDoorLockRepository
 * @package App\Repositories
 * @version May 7, 2019, 6:00 pm CST
 *
 * @method DevDoorLock findWithoutFail($id, $columns = ['*'])
 * @method DevDoorLock find($id, $columns = ['*'])
 * @method DevDoorLock first($columns = ['*'])
*/
class DevDoorLockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'me',
        'model',
        'name',
        'state',
        'battery',
        'region_id',
        'region_name',
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
        return DevDoorLock::class;
    }
}
