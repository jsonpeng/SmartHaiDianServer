<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version May 7, 2019, 6:28 pm CST
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'name',
        'pwd',
        'welcome_sound_url',
        'mobile',
        'sex',
        'welcome'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
