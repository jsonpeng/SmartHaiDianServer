<?php

namespace App\Repositories;

use App\Models\Preference;
use App\Models\DevScene;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PreferenceRepository
 * @package App\Repositories
 * @version May 8, 2019, 2:40 pm CST
 *
 * @method Preference findWithoutFail($id, $columns = ['*'])
 * @method Preference find($id, $columns = ['*'])
 * @method Preference first($columns = ['*'])
*/
class PreferenceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'scene_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Preference::class;
    }

    public function userPreferenceSceneName($user_id)
    {
        $preference = $this->userPreferenceScene($user_id);
        if(empty($preference))
        {
            return '无';
        }
        $scene = DevScene::find($preference);
        if(empty($scene))
        {
            return '无';
        }
        return $scene->name.'['.app("common")->RegionRepo()->getNameById($scene->region_id).']';
    }

    /**
     * 用户偏好得场景
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function userPreferenceScene($user_id)
    {
        return optional(Preference::where('user_id',$user_id)->first())->scene_id;
    }

    /**
     * 操作用户得偏好场景
     * @param  [type] $user_id  [description]
     * @param  [type] $scene_id [description]
     * @return [type]           [description]
     */
    public function actionUserPreferenceScene($action = 'create',$user_id,$scene_id = null)
    {
        if($action == 'select')
        {
            return $this->userPreferenceScene($user_id);
        }elseif($action == 'create')
        {
            if($scene_id)
            {
                Preference::create(['user_id'=>$user_id,'scene_id'=>$scene_id]);
            }
        }
        elseif($action == 'delete')
        {
                Preference::where('user_id',$user_id)->delete();
        }
        elseif($action == 'update')
        {
            if($scene_id)
            {
                $preference = Preference::where('user_id',$user_id)->first();
                if($preference){
                    $preference = $preference->update(['scene_id'=>$scene_id]);
                }
                else{
                    Preference::create(['user_id'=>$user_id,'scene_id'=>$scene_id]);
                }
            }
            else{
                Preference::where('user_id',$user_id)->delete();
            }
        }
    }

}
