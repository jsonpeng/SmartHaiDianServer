<?php

namespace App\Repositories;

use App\Models\DevCommand;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevCommandRepository
 * @package App\Repositories
 * @version May 1, 2019, 10:57 am CST
 *
 * @method DevCommand findWithoutFail($id, $columns = ['*'])
 * @method DevCommand find($id, $columns = ['*'])
 * @method DevCommand first($columns = ['*'])
*/
class DevCommandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'me',
        'idx',
        'type',
        'val',
        'tag',
        'agt',
        'scene_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevCommand::class;
    }
}
