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
     * 用户偏好得所有场景id数组
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function userPreferenceScenesArr($user_id)
    {
        $sceneArr = Preference::where('user_id',$user_id)->get();
        $arr = [];
        if(count($sceneArr))
        {
            foreach ($sceneArr as $key => $item) 
            {
                $arr[] = $item->scene_id;
            }
        }
        return $arr;
    }


    /**
     * 操作用户得偏好场景
     * @param  [type] $user_id  [description]
     * @param  [type] $scene_id [description]
     * @return [type]           [description]
     */
    public function actionUserPreferenceScene($action = 'create',$user_id,$scene_id = null)
    {

        if(!is_array($scene_id))
        {
            $scene_id = explode(',', $scene_id);
        }

        if($action == 'select')
        {
            return $this->userPreferenceScene($user_id);
        }elseif($action == 'create')
        {
            if(count($scene_id) && !empty($scene_id))
            {
                foreach ($scene_id as $key => $scene) 
                {
                      Preference::create(['user_id'=>$user_id,'scene_id'=>$scene]);
                }
            }
        }
        elseif($action == 'delete')
        {
                Preference::where('user_id',$user_id)->delete();
        }
        elseif($action == 'update')
        {
            if(count($scene_id) && !empty($scene_id))
            {
            
                Preference::where('user_id',$user_id)->delete();
            
                foreach ($scene_id as $key => $scene) 
                {
                  Preference::create(['user_id'=>$user_id,'scene_id'=>$scene]);
                }
                
            }
            else{
                Preference::where('user_id',$user_id)->delete();
            }
        }
    }

}
