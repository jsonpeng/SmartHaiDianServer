<?php

namespace App\Http\Controllers\Smart\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

class RegionApiController extends AppBaseController
{
	/**
     * 获取所有得区域
     *
     * @SWG\Get(path="/api/region/all",
     *   tags={"区域模块"},
     *   summary="获取所有得区域",
     *   description="获取所有得区域",
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
	public function getRegionAll()
	{
		return zcjy_callback_data(\Smart::getReionAll());
	}
}