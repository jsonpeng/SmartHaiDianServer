<?php

namespace App\Http\Controllers\Smart\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

class PostApiController extends AppBaseController
{
    /**
     * 获取指定分类的文章列表
     *
     * @SWG\Get(path="/api/posts/get_slug/{cat_slug}",
     *   tags={"文案模块"},
     *   summary="获取指定分类的文章列表",
     *   description="获取指定分类的文章列表",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="cat_slug",
     *     type="string",
     *     description="分类别名",
     *     required=true,
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回文章列表",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
	public function getCatSlugPosts($cat_slug)
	{
		return zcjy_callback_data(app('common')->PostRepo()->getCatSlugPosts($cat_slug));
	}

    /**
     * 获取文章详情
     *
     * @SWG\Get(path="/api/posts/detail/{id}",
     *   tags={"文案模块"},
     *   summary="获取文章详情",
     *   description="获取文章详情",
     *   operationId="testRecordsStore",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="id",
     *     type="integer",
     *     description="文章id",
     *     required=true,
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="status_code=0请求成功,status_code=1请求失败(缺少请求参数,参数验证失败等),data返回文章详情",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="服务器出错",
     *     ),
     * )
     */
     public function getPostDetail($id)
     {
          return zcjy_callback_data(app('common')->PostRepo()->getPostDetail($id));
     }
}