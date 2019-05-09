<?php

namespace App\Repositories;

use App\Models\GatewayDev;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GatewayDevRepository
 * @package App\Repositories
 * @version May 9, 2019, 4:48 pm CST
 *
 * @method GatewayDev findWithoutFail($id, $columns = ['*'])
 * @method GatewayDev find($id, $columns = ['*'])
 * @method GatewayDev first($columns = ['*'])
*/
class GatewayDevRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'me'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GatewayDev::class;
    }
}
