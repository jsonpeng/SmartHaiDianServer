<?php
include_once 'Shop.php';
include_once 'Smart.php';
use App\User;


function zcjy_data($data=null)
{
  return response()->json($data);
}

/**
 * 处理浮点数 数组或者直接浮点数
 * @param  [type]  $data  [description]
 * @param  integer $limit [description]
 * @return [type]         [description]
 */
function dealFloatData($data,$limit = 2)
{
    if(is_array($data))
    {
      foreach ($data as $key => $val) 
      {
        $data[$key] = sprintf("%.2f", $val);
      }
    }
    else{
      $data = sprintf("%.2f", $data);
    }
    return is_array($data) ? $data : $data;
}

/**
 * 直接获取必须参数
 * @param  [type]  $model        [description]
 * @param  boolean $return_array [description]
 * @return [type]                [description]
 */
function modelRequiredParam($model,$return_array=false){
  if(method_exists($model,'model'))
  {
      $model = $model->model();
  }
  $requireds = $model::$rules;
  $attr = [];
  foreach ($requireds as $key => $value) 
  {
      array_push($attr,$key);
  }
  $attr = !$return_array ? implode(',',$attr) : $attr;
 return $attr;
}

function user_by_id($id){
    //return Cache::remember('zcjy_user_by_id_'.$id, Config::get('web.shrottimecache'), function() use ($id) {
        try {
           return User::find($id);
        } catch (Exception $e) {
            return null;
        }
     
    //});
}

//给予token
function generateToken($user)
{
   $token = zcjy_base64_en($user->id.'__'.strtotime($user->created_at).'__'.time());
   return $token;
}

//当前api用户
function zcjy_api_user($token){
     $token = explode('__', zcjy_base64_de($token));
     return user_by_id($token[0]);
}

//加密
function zcjy_base64_en($str){
    $str = str_replace('/','@',str_replace('+','-',base64_encode($str)));
    return $str;
}

//解密
function zcjy_base64_de($str){
    $encode_arr = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
    $str = base64_decode(str_replace('@','/',str_replace('-','+',$str)));
    $encoded = mb_detect_encoding($str, $encode_arr);
    $str = iconv($encoded,"utf-8",$str);
    return $str;
}

//获取值
function valueOfKey($key)
{
  return app('setting')->valueOfKey($key);
}

/**
 * 获取毫秒时间戳
 * @return [type] [description]
 */
function millisecond()
{  
    $time = explode (" ", microtime () );   
    $time = $time [1] . ($time [0] * 1000);   
    $time2 = explode ( ".", $time );   
    $time = $time2 [0];  
    return $time;  
} 

/**
 * 管理员权限 是否有对应的permission_name
 * @param  [type] $permission_name [description]
 * @param  [type] $gard_name       [description]
 * @return [type]                  [description]
 */
function adminCan($permission_name = null,$gard_name = null)
{
    $admin = auth('admin')->user();
    if(!empty($permission_name))
    {
        //$can = $admin->can($permission_name, 'admin');
        if($admin->type == '管理员')
        {
          return true;
        }
        elseif($admin->type == '达人')
        {
          if($permission_name == '文章编辑')
          {
            return true;
          }
            return false;
        }
    }
    else{
        return false;
    }
}

//空格列表处理
function spaceList($attr)
{
  $list= preg_replace("/\n|\r\n/", "_",$attr);
  
  return explode('_',$list);;
}

/**
 * [把文字变成链接 并且带上颜色]
 * @param  [type]  $string [文字]
 * @param  [type]  $link   [链接]
 * @param  string  $color  [颜色 默认橙色]
 * @param  boolean $nbsp   [是否加左右间隔]
 * @return [type]          [description]
 */
function a_link($string,$link,$color='orange',$nbsp=true){
     return $nbsp ? '&nbsp;&nbsp;<a target=_blank href='.$link.' style=color:'.$color.'>'.$string.'</a>&nbsp;&nbsp;' : '<a target=_blank href='.$link.' style=color:'.$color.'>'.$string.'</a>';
}


/**
 * [初始化查询索引状态]
 * @param  [Repository / Model] $obj [description]
 * @return [type]                    [description]
 */
function defaultSearchState($obj){
         if(!empty($obj)){
            return !empty(optional($obj)->model())
                ?($obj->model())::where('id','>',0)
                :$obj::where('id','>',0);
         }else{
            return [];
         }
}

/**
 * [模型默认分页]
 * @param  [type] $obj  [description]
 * @param  [type] $page [description]
 * @return [type]       [description]
 */
function defaultPaginate($obj,$page=null,$created_at_sort='desc'){
    return empty($page) ? $obj->orderBy('created_at',$created_at_sort)->paginate(15) : $obj->orderBy('created_at',$created_at_sort)->paginate($page);
}



/**
 * [接口请求回转数据格式]
 * @param  type    $data     [成功/失败提示]
 * @param  integer $code     [0成功 1失败]
 * @param  string  $api      [默认不传是api格式 传web是web格式]
 * @return [type]            [description]
 */
function zcjy_callback_data($data=null,$code=0,$api='api'){
    return $api === 'api'
        ? api_result_data_tem($data,$code)
        : web_result_data_tem($data,$code);
}


/**
 * [api接口请求回转数据]
 * @param  [type]  $message  [成功/失败提示]
 * @param  integer $code     [0成功 1失败]
 * @return [type]            [description]
 */
function api_result_data_tem($data=null,$status_code=0){
     return response()->json(['status_code'=>$status_code,'data'=>$data]);
}


/**
 * [web程序请求回转数据]
 * @param  [type]  $message  [成功/失败提示]
 * @param  integer $code     [0成功 1失败]
 * @return [type]            [description]
 */
function web_result_data_tem($message=null,$code=0){
    return response()->json(['code'=>$code,'message'=>$message]);
}


function filterCode($element)
{
    return $element->platformChannel->type == 'EXCHANGE_CODE';
}