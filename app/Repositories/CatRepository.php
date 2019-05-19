<?php

namespace App\Repositories;

use App\Models\Cat;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CatRepository
 * @package App\Repositories
 * @version May 19, 2019, 12:44 pm CST
 *
 * @method Cat findWithoutFail($id, $columns = ['*'])
 * @method Cat find($id, $columns = ['*'])
 * @method Cat first($columns = ['*'])
*/
class CatRepository extends BaseRepository
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
        return Cat::class;
    }
}
