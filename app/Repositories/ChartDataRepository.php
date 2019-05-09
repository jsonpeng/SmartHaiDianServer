<?php

namespace App\Repositories;

use App\Models\ChartData;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ChartDataRepository
 * @package App\Repositories
 * @version May 9, 2019, 1:56 pm CST
 *
 * @method ChartData findWithoutFail($id, $columns = ['*'])
 * @method ChartData find($id, $columns = ['*'])
 * @method ChartData first($columns = ['*'])
*/
class ChartDataRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idx',
        'desc',
        'val',
        'time_span',
        'record_date',
        'record_time'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ChartData::class;
    }
}
