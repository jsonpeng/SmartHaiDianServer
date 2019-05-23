<?php

namespace App\Repositories;

use App\Models\Region;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RegionRepository
 * @package App\Repositories
 * @version May 1, 2019, 10:32 am CST
 *
 * @method Region findWithoutFail($id, $columns = ['*'])
 * @method Region find($id, $columns = ['*'])
 * @method Region first($columns = ['*'])
*/
class RegionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'desc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Region::class;
    }

    /**
     * 根据区域id获取区域名称
     * @param  [type] $region_id [description]
     * @return [type]            [description]
     */
    public function getNameById($region_id)
    {
        return optional($this->findWithoutFail($region_id))->des;
    }

    /**
     * 为input 输入值带上地区的name
     * @param  [type] $region_id [description]
     * @param  [type] $name      [description]
     * @return [type]            [description]
     */
    public function attachReginNameByInputId($input,$name = 'name')
    {
         if(isset($input['region_id'])){
           $input['region_name'] = optional($this->findWithoutFail($input['region_id']))->{$name};
         }
         return $input;
    }
}
