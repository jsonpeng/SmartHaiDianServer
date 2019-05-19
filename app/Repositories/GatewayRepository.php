<?php

namespace App\Repositories;

use App\Models\Gateway;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GatewayRepository
 * @package App\Repositories
 * @version May 19, 2019, 11:29 am CST
 *
 * @method Gateway findWithoutFail($id, $columns = ['*'])
 * @method Gateway find($id, $columns = ['*'])
 * @method Gateway first($columns = ['*'])
*/
class GatewayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Gateway::class;
    }
}
