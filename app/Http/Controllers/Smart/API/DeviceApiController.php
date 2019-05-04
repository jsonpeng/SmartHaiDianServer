<?php

namespace App\Http\Controllers\Smart\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

class DeviceApiController extends AppBaseController
{



	/**
     * 获取当前网关的所有设备
     *
     * @SWG\Get(path="/api/device/all",
     *   tags={"设备模块"},
     *   summary="获取当前网关的所有设备",
     *   description="获取当前网关的所有设备",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回设备列表",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
	public function getAllDevices()
	{
		return zcjy_callback_data(\Smart::getAllDevicesAndByRegionName());
	}

     /**
     * 获取指定模型的所有设备
     *
     * @SWG\Get(path="/api/device/get_model/{model}",
     *   tags={"设备模块"},
     *   summary="获取指定区域的所有设备",
     *   description="获取指定区域的所有设备",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="model",
     *     type="string",
     *     description="指定模型",
     *     required=true,
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回设备列表",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
     public function getModelDevices($model)
     {
          return zcjy_callback_data(\Smart::getModelDevices($model));
     }

	/**
     * 获取指定区域的所有设备
     *
     * @SWG\Get(path="/api/device/get_region/{region_name}",
     *   tags={"设备模块"},
     *   summary="获取指定区域的所有设备",
     *   description="获取指定区域的所有设备",
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
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回设备列表",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
	public function getRegionDevices($region_name)
	{
		return zcjy_callback_data(\Smart::getAllDevicesAndByRegionName($region_name));
	}

	/**
     * 发起单个设备添加
     *
     * @SWG\Get(path="/api/device/add",
     *   tags={"设备模块"},
     *   summary="发起单个设备添加",
     *   description="发起单个设备添加",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
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
	public function addDevice(Request $request)
	{
		return \Smart::addDeviceRequest();
	}


	/**
     * 发起单个设备控制
     *
     * @SWG\Get(path="/api/device/control",
     *   tags={"设备模块"},
     *   summary="发起单个设备控制",
     *   description="发起单个设备控制,需要设备的me以及model信息",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="query",
     *     name="me",
     *     type="string",
     *     description="设备唯一id,通过获取所有设备列表获取",
     *     required=true,
     *   ),
     *   @SWG\Parameter(
     *     in="query",
     *     name="model",
     *     type="string",
     *     description="设备型号,通过获取所有设备列表获取",
     *     required=true,
     *   ),
     *   @SWG\Parameter(
     *     in="query",
     *     name="switch",
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
	public function controlDevice(Request $request)
	{
		return \Smart::ControlRequest($request);
	}

	/**
     * 发起多个设备控制
     *
     * @SWG\Post(path="/api/device/control_muti",
     *   tags={"设备模块"},
     *   summary="发起多个设备控制",
     *   description="发起多个设备控制",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="query",
     *     name="param",
     *     type="string",
     *     description="组装单个控制的命令 传多维json字符串 例如:多个控制命令参考格式",
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
	public function controlMutiDevice(Request $request)
	{
		return \Smart::mutiControlRequest($request->get('param'));
	}

}