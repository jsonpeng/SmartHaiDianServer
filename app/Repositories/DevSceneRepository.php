<?php

namespace App\Repositories;

use App\Models\DevScene;
use InfyOm\Generator\Common\BaseRepository;
use App\Models\DevCommand;
use App\Models\DevLight;
use App\Models\DevCurtain;
use App\Models\DevSensor;
use App\Models\DevLfScene;
use Log;

/**
 * Class DevSceneRepository
 * @package App\Repositories
 * @version May 1, 2019, 10:44 am CST
 *
 * @method DevScene findWithoutFail($id, $columns = ['*'])
 * @method DevScene find($id, $columns = ['*'])
 * @method DevScene first($columns = ['*'])
*/
class DevSceneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'enabled',
        'region_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        $switch = \Smart::getCacheSceneSwitch();
        if($switch === 1)
        {
            return DevScene::class;
        }
        else{
            return DevLfScene::class;
        }
    }

    /**
     * 获取场景名称通过场景id
     * @param  [type] $scene_id [description]
     * @return [type]           [description]
     */
    public function getSceneNameById($scene_id)
    {
        return optional($this->findWithoutFail($scene_id))->name;
    }

    /**
     * 设置场景开关
     * @param [type] $swith_status [description]
     * @param [type] $scene        [description]
     */
    public function setSceneSwitch($swith_status,$scene,$update_enabled = null)
    {
        /**
         * 如果开启一个场景 先把该区域关联的所有场景关闭 一个区域只能同时开启一个场景
         */
        if($swith_status)
        {
            //开启场景把 该区域的其他场景关闭
            $this->updateSceneRegionEnableStatus($scene->region_id,$scene->id);

            $switch = \Smart::getCacheSceneSwitch();
            if($switch === 1)
            {
                //执行关联的操作命令
                $this->startMutiControlRequest($scene->id);
            }
            else{
                \Smart::setLfScene($scene);
            }
        }
        else{
            // Log::info('关闭了场景');
            //关闭场景 关闭当前区域的所有设备
            $this->closeSceneControlRequest($scene->region_id);
        }

        //如果开启了更新
        if($update_enabled){
            $scene->update(['enabled' => $swith_status ? 1 : 0]);
        }

        return true;
    }

    /**
     * 开始联动控制请求
     * @param  [type] $scene_id [description]
     * @return [type]           [description]
     */
    public function startMutiControlRequest($scene_id)
    {
        $commandDatas = DevCommand::where('scene_id',$scene_id)
        ->select('me','idx','type','val','agt')
        ->get();

        //操作DB更新设备状态
        // if(count($commandDatas)){
        //     //批量更新设备开关状态
        //     foreach ($commandDatas as $key => $command) 
        //     {   
        //         //灯光
        //         if($command->type == '0x81' || $command->type == '0xff')
        //         {
        //            DevLight::where('me',$command->me)->update(['is_on'=>1]);
        //         }//窗帘
        //         else if($command->type == '0xCF'){
        //             DevCurtain::where('me',$command->me)->update(['is_on'=>1]);
        //         }
        //         else{
        //           DevLight::where('me',$command->me)->update(['is_on'=>0]);
        //         }
        //     }
        // }
        if(count($commandDatas))
        {
            $commandDatas = json_encode($commandDatas);
            Log::info('开启场景命令:'.$commandDatas);
            //发起请求
            \Smart::mutiControlRequest($commandDatas);
        }
    }

    //关闭当前区域内的场景
    public function closeSceneControlRequest($region_id)
    {
        $commandDatas = [];

        //灯光联动
        $lights = DevLight::where('region_id',$region_id)
        ->select('me','idx','agt')
        ->get();

        //操作DB更新设备状态
        if(count($lights))
        {
            foreach ($lights as $key => $light) 
            {
                    // $light->update(['is_on'=>0]);
                    $commandDatas[] = [
                        'me'   => $light->me,
                        'idx'  => $light->idx,
                        'agt'  => $light->agt,
                        'type' => '0x80',
                        'val'  => '0'
                    ];

            }
        }

        //燃气传感器
        $sensors = DevSensor::where('region_id',$region_id)
        ->where('type',2)
        ->where('state',1)
        ->get();

         if(count($sensors))
        {
            foreach ($sensors as $key => $sensor) 
            {
                    $commandDatas[] = [
                        'me'   => $sensor->me,
                        'idx'  => $sensor->idx,
                        'agt'  => $sensor->agt,
                        'type' => '0x80',
                        'val'  => '0'
                    ];
            }
        }

        //窗帘电机
        $dooyas = DevCurtain::where('region_id',$region_id)->where('state',1)->get();

        if(count($dooyas))
        {
            foreach ($dooyas as $key => $dooya) 
            {
                    // $commandDatas[] = [
                    //     'me'   => $dooya->me,
                    //     'idx'  => $dooya->idx,
                    //     'agt'  => $dooya->agt,
                    //     'type' => '0xCF',
                    //     'val'  => '0'
                    // ];
                    $commandDatas[] = [
                        'me'   => $dooya->me,
                        'idx'  => $dooya->idx,
                        'agt'  => $dooya->agt,
                        'type' => '0xCE',
                        'val'  => '0x80'
                    ];
                    // $dooya->update(['is_on'=>0]);
            }
        }
      
        if(count($commandDatas))
        {
            $commandDatas = json_encode($commandDatas);
            Log::info('关闭场景命令:'.$commandDatas);
            //发起请求
            \Smart::mutiControlRequest($commandDatas);
        }

    }


    /**
     * 更新场景相关区域的状态
     * @param  [type] $region_id [description]
     * @param  [type] $scene_id  [description]
     * @return [type]            [description]
     */
    public function updateSceneRegionEnableStatus($region_id,$scene_id)
    {
         DevScene::where('region_id',$region_id)
         ->where('id','<>',$scene_id)
         ->update(['enabled'=>0]);
         return true;
    }
}
