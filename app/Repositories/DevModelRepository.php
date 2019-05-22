<?php

namespace App\Repositories;

use App\Models\DevModel;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DevModelRepository
 * @package App\Repositories
 * @version May 22, 2019, 9:08 pm CST
 *
 * @method DevModel findWithoutFail($id, $columns = ['*'])
 * @method DevModel find($id, $columns = ['*'])
 * @method DevModel first($columns = ['*'])
*/
class DevModelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'model'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DevModel::class;
    }
}
