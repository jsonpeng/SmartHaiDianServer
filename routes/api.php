<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * 基础api
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
		$api->group(['namespace' => 'App\Http\Controllers\Smart\API','middleware' => 'acces'], function ($api) {

		/**
		 * 区域相关api
		 */
		$api->group(['prefix' => 'region'], function ($api) {
			//获取所有设备
			$api->get('all','RegionApiController@getRegionAll');
		});


		/**
		 * 设备相关api
		 */
	    $api->group(['prefix' => 'device'], function ($api) {
			//获取所有设备
			$api->get('all','DeviceApiController@getAllDevices');
			//获取指定区域内的设备
			$api->get('get_region/{region_name}','DeviceApiController@getRegionDevices');
			//获取指定模型的设备
			$api->get('get_model/{model}','DeviceApiController@getModelDevices');
			//发起设备控制
			$api->get('control','DeviceApiController@controlDevice');
			//灯光控制
			$api->get('light_control','DeviceApiController@controlLight');
			//发起设备添加
			$api->get('add','DeviceApiController@addDevice');
			$api->post('control_muti','DeviceApiController@controlMutiDevice');
	    });

	    /**
		 * 情景相关api
		 */
	    $api->group(['prefix' => 'scene'], function ($api) {
			//获取所有情景
			$api->get('all','SceneApiControlller@getSceneAll');
			//获取指定区域的情景模式
			$api->get('get_region/{region_name}','SceneApiControlller@getSceneByRegionName');
			//操作场景 
			$api->get('switch/{scene_id}/{action}','SceneApiControlller@swithScene');

	    });

	});
});
