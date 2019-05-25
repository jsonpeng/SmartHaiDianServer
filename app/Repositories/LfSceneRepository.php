<?php

namespace App\Repositories;

use App\Models\LfScene;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LfSceneRepository
 * @package App\Repositories
 * @version May 25, 2019, 11:05 am CST
 *
 * @method LfScene findWithoutFail($id, $columns = ['*'])
 * @method LfScene find($id, $columns = ['*'])
 * @method LfScene first($columns = ['*'])
*/
class LfSceneRepository extends BaseRepository
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
        return LfScene::class;
    }
}
