<?php

namespace App\Http\Controllers\Smart\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

//灯光设备
use App\Models\DevLight;
//窗帘电机
use App\Models\DevCurtain;
//传感器
use App\Models\DevSensor;
//智能门锁
use App\Models\DevDoorLock;
//设备分类
use App\Models\DevModel;

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
     * 获取当前网关的所有设备模型分类
     *
     * @SWG\Get(path="/api/device/all_model_cat",
     *   tags={"设备模块"},
     *   summary="获取当前网关的所有设备模型分类",
     *   description="获取当前网关的所有设备模型分类",
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
     public function getAllModelDev()
     {
          return zcjy_callback_data(DevModel::all());
     }

     /**
     * 获取指定模型的所有设备
     *
     * @SWG\Get(path="/api/device/get_model/{model}",
     *   tags={"设备模块"},
     *   summary="获取指定模型的所有设备",
     *   description="获取指定模型的所有设备",
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
     * 发起灯光无极控制调色
     *
     * @SWG\Get(path="/api/device/light_control",
     *   tags={"设备模块"},
     *   summary="发起灯光无极控制调色",
     *   description="发起灯光无极控制调色,需要设备的me信息",
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
     *     name="color",
     *     type="integer",
     *     description="0=>关闭 其他的请传入转换后的十六进制RGB数值",
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
     public function controlLight(Request $request)
     {
          return \Smart::controlLightRequest($request);
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


     /**
      * 返回chart数据格式
      * @return [type] [description]
      */
     private function returnChartData($data)
     {
          return response()->json(['code'=>0,'data'=>$data,'msg'=>null]);
     }

    /**
     * 获取设备总数-在线数
     *
     * @SWG\Get(path="/api/device/chart/online_and_total",
     *   tags={"设备模块"},
     *   summary="获取设备总数-在线数",
     *   description="获取设备总数-在线数",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回设备分类及数量",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
     public function getDevAllNumAndOnlineNum(Request $request)
     {
          $devItem = 
          [
               'name'   => '',
               'online' => 0,
               'total'  => 0,
               'data'   => []
          ];

          $devAll = [];

          //智能灯泡
          $devItem['name']   = '智能灯泡';
          $devItem['online'] = DevLight::where('model','SL_LI_RGBW')->where('state',1)->count();
          $devItem['total']  = DevLight::where('model','SL_LI_RGBW')->count();
          $devAll[] = $devItem;

          //智能灯泡/灯带
          $devItem['name']   = '智能灯带';
          $devItem['online'] = DevLight::where('model','SL_CT_RGBW')->where('state',1)->count();
          $devItem['total']  = DevLight::where('model','SL_CT_RGBW')->count();
          $devAll[] = $devItem;

          //智能窗帘电机
          $devItem['name']   = '智能窗帘电机';
          $devItem['online'] = DevCurtain::where('state',1)->count();
          $devItem['total']  = DevCurtain::count();
          $devAll[] = $devItem;

          //超级碗
          $devItem['name']   = '超级碗';
          $devItem['online'] = DevLight::where('model','SL_SPOT')->where('state',1)->count();
          $devItem['total']  = DevLight::where('model','SL_SPOT')->count();
          $devAll[] = $devItem;

          //传感器
          $devItem['name']   = '传感器';
          $devItem['online'] = DevSensor::where('state',1)->count();
          $devItem['total']  = DevSensor::count();
          $devAll[] = $devItem;
          
          //智能门锁
          $devItem['name']   = '智能门锁';
          $devItem['online'] = DevDoorLock::where('state',1)->count();
          $devItem['total']  = DevDoorLock::count();
          $devAll[] = $devItem;
          return $this->returnChartData($devAll);
     }


    /**
     * 获取各区域内的设备在线数量
     *
     * @SWG\Get(path="/api/device/chart/regions_online_total",
     *   tags={"设备模块"},
     *   summary="获取各区域内的设备在线数量",
     *   description="获取各区域内的设备在线数量",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回设备分类及数量",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
     public function getAllRegionDev(Request $request)
     {
          $allDevices = \Smart::getAllDevicesAndByRegionName();
          
          $xuanguanNum = 0;
          $ketingNum   = 0;
          $shufangNum  = 0;
          $chufangNum  = 0;

          if(count($allDevices))
          {
               foreach ($allDevices as $key => $dev) 
               {
                   if($dev['region_name'] == '玄关')
                   {
                    $xuanguanNum++;
                   }
                   elseif($dev['region_name'] == '客厅')
                   {
                    $ketingNum++;
                   }
                   elseif($dev['region_name'] == '书房')
                   {
                    $shufangNum++;
                   }
                   elseif($dev['region_name'] == '厨房')
                   {
                    $chufangNum++;
                   }
               }
          }

          $allRegionDev = [
               ['value' => ['玄关',$xuanguanNum]],
               ['value' => ['客厅',$ketingNum]],
               ['value' => ['书房',$shufangNum]],
               ['value' => ['厨房',$chufangNum]]
          ];
          return $this->returnChartData($allRegionDev);
     }

}