<?php

namespace App\Repositories;

use App\Models\DevIdxDay;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevIdxDayRepository
 * @package App\Repositories
 * @version May 8, 2019, 4:36 pm CST
 *
 * @method DevIdxDay findWithoutFail($id, $columns = ['*'])
 * @method DevIdxDay find($id, $columns = ['*'])
 * @method DevIdxDay first($columns = ['*'])
*/
class DevIdxDayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idx',
        'val',
        'record_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevIdxDay::class;
    }
}
