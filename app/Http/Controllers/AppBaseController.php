<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Input;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    /**
     * 清空缓存
     * @return [type] [description]
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return ['status'=>true,'msg'=>''];
    }

    /**
     * 上传文件
     * @return [type] [description]
     */
    public function uploads()
    {
        $file =  Input::file('file');
        return app('common')->uploadFiles($file);
    }
}
