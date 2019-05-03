<?php

namespace App\Http\Controllers\Smart\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

class SceneApiControlller extends AppBaseController
{
	/**
     * 获取所有场景
     *
     * @SWG\Get(path="/api/scene/all",
     *   tags={"场景模块"},
     *   summary="获取所有场景",
     *   description="获取所有场景",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回场景列表",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
	public function getSceneAll()
	{
		return zcjy_callback_data(\Smart::getSceneAll());
	}

	/**
     * 获取指定区域的所有场景
     *
     * @SWG\Get(path="/api/scene/get_region/{region_name}",
     *   tags={"场景模块"},
     *   summary="获取指定区域的所有场景",
     *   description="获取指定区域的所有场景",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="region_name",
     *     type="string",
     *     description="区域name 
     *     kt : 客厅,
     *     cf : 厨房,
     *     sf : 书房,
     *     dm : 大门,
     *     如传 kt 取出客厅的所有设备
     *     ",
     *     required=true,
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回场景列表",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
	public function getSceneByRegionName($region_name)
	{
		return zcjy_callback_data(\Smart::getScenesByRegionName($region_name));
	}

	/**
     * 打开/关闭单个场景
     *
     * @SWG\Get(path="/api/scene/switch/{scene_id}/{action}",
     *   tags={"场景模块"},
     *   summary="打开/关闭单个场景",
     *   description="打开/关闭单个场景",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="scene_id",
     *     type="integer",
     *     description="场景id,通过获取所有场景或者获取指定场景获取",
     *     required=true,
     *   ),
     *   @SWG\Parameter(
     *     in="path",
     *     name="action",
     *     type="integer",
     *     description="1开启 0关闭",
     *     required=true,
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回操作结果",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
	public function swithScene($scene_id,$action)
	{
		return \Smart::swithScene($scene_id,$action);
	}
}