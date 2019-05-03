<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

use App\Models\Cities;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Store;
use App\User;
use Carbon\Carbon;

/**
 * 获取设置信息
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
function getSettingValueByKey($key){
    return app('setting')->valueOfKey($key);
}

function getSettingValueByKeyCache($key){
    return Cache::remember('getSettingValueByKey'.$key, Config::get('web.cachetime'), function() use ($key){
        return getSettingValueByKey($key);
    });
}

function objtoarr($obj){
    $ret = array();
    foreach($obj as $key =>$value){
        if(gettype($value) == 'array' || gettype($value) == 'object'){
            $ret[$key] = objtoarr($value);
        }else{
            $ret[$key] = $value;
        }
    }
    return $ret;
}


/**
 * 获取主题设置
 * @return [array] [theme setting]
 */
function theme()
{
    $themes = Config::get('zcjytheme.theme');
    $themeName = app('setting')->valueOfKey('theme');
    if (empty($themeName)) {
        $themeName = 'default';
    }
    foreach ($themes as $theme) {
        if ($theme['name'] == $themeName) {
            return $theme;
        }
    }
    return [
        'name' => 'default',
        'parent' => 'default',
        'display_name' => '默认主题',
        'image' => 'themes/default/cover.png',
        'des' => '默认主题',
        'maincolor' => '#ff4e44',
        'secondcolor' => '#84d4da'
    ];
}

/**
 * 主色调
 * @return [type] [description]
 */
function themeMainColor()
{
    $theme_maincolor = app('setting')->valueOfKey('theme_main_color');
    if (empty($theme_maincolor)) {
        return theme()['maincolor'];
    }
    return $theme_maincolor;
}

/**
 * 次色调
 * @return [type] [description]
 */
function themeSecondColor()
{
    $theme_secondcolor = app('setting')->valueOfKey('theme_second_color');
    if (empty($theme_secondcolor)) {
        return theme()['secondcolor'];
    }
    return $theme_secondcolor;
}

/**
 * 前端页面路径
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
function frontView($name)
{
    $themeSetting = theme();
    if (view()->exists('front.'.theme()['name'].'.'.$name)) {
        return 'front.'.theme()['name'].'.'.$name;
    }else{
        if (view()->exists('front.'.theme()['parent'].'.'.$name)) {
            return 'front.'.theme()['parent'].'.'.$name;
        }else{
            
            return 'front.default.'.$name;
        }
    }
}


/**
 * 功能是否被打开 （需要系统 和商家同时开启该功能）
 * @param  [type] $func_name [description]
 * @return [type]            [description]
 */
function funcOpen($func_name)
{
    $config  = Config::get('web.'.$func_name);
    if ($config && sysOpen($func_name)) {
        return true;
    }else{
        return false;
    }
    //return empty($config) ? false : $config;
}

function funcOpenCache($func_name)
{
    return Cache::remember('funcOpen'.$func_name, Config::get('web.cachetime'), function() use ($func_name){
        return funcOpen($func_name);
    });
}

/**
 * 商家自己控制功能是否打开
 * @param  [type] $func_name [description]
 * @return [type]            [description]
 */
function sysOpen($func_name)
{
    $config  = intval( getSettingValueByKey($func_name) );
    return empty($config) ? false : true;
}

function sysOpenCache($func_name)
{
    return Cache::remember('sysOpen'.$func_name, Config::get('web.cachetime'), function() use ($func_name){
        return sysOpen($func_name);
    });
}


//将时间处理成以偶数小时开头，分跟秒为0的时间
function processTime($cur_time)
{
    // if ($cur_time->hour%2) {
    //     $cur_time->subHour();
    // }
    $cur_time->hour = 0;
    $cur_time->minute = 0;
    $cur_time->second = 0;
    return $cur_time;
}


/**
 * 笛卡尔积
 * @return [type] [description]
 */
function combineDika() {
    $data = func_get_args();
    $data = current($data);
    $cnt = count($data);
    $result = array();
    $arr1 = array_shift($data);
    foreach($arr1 as $key=>$item) 
    {
        $result[] = array($item);
    }       

    foreach($data as $key=>$item) 
    {                                
        $result = combineArray($result,$item);
    }
    return $result;
}

/**
 * 数组转对象
 * @param  [type] $d [description]
 * @return [type]    [description]
 */
function arrayToObject($d) {
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object) array_map(__FUNCTION__, $d);
    }
    else {
        // Return object
        return $d;
    }
}

/**
 * 数组转字符串
 * @param  [type] $re1 [description]
 * @return [type]      [description]
 */
function arrayToString($re1){
    $str = "";
    $cnt = 0;
    foreach ($re1 as $value)
    {
        if($cnt == 0) {
            $str = $value;
        }
        else{
            $str = $str.','.$value;
        }
        $cnt++;
    }
}

/**
 * 两个数组的笛卡尔积
 * @param unknown_type $arr1
 * @param unknown_type $arr2
*/

function combineArray($arr1,$arr2) {         
    $result = array();
    foreach ($arr1 as $item1) 
    {
        foreach ($arr2 as $item2) 
        {
            $temp = $item1;
            $temp[] = $item2;
            $result[] = $temp;
        }
    }
    return $result;
}

/**
 * 删除数字元素
 * @param  [type] $arr [description]
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
function array_remove($arr, $key){
    if(!array_key_exists($key, $arr)){
        return $arr;
    }
    $keys = array_keys($arr);
    $index = array_search($key, $keys);
    if($index !== FALSE){
        array_splice($arr, $index, 1);
    }
    return $arr;

}


/**
 * [冒泡排序]
 * @param  [type] $arr [description]
 * @return [type]      [description]
 */
function bubbleSort($arr){
    $arrLen = count($arr);
    if($arrLen){
        #step1
        // for ($i=1; $i < $arrLen; $i++) { 
        //     for ($k=0; $k <$arrLen - $i ; $k++) { 
        //        if($arr[$k] > $arr[$k+1]){
        //              $temp = $arr[$k+1];
        //              $arr[$k+1] = $arr[$k];
        //              $arr[$k] = $temp;
        //        }
        //     }
        // }
        #step2
        for ($i=$arrLen;$i>0;$i--) { 
            for ($k=$arrLen-$i-1;$k>=0;$k--) { 
                 if($arr[$k] > $arr[$k+1]){
                    $temp = $arr[$k+1];
                    $arr[$k+1] = $arr[$k];
                    $arr[$k] = $temp;
                 }
            }
        }
        #step3
        // $arr_arr = []; 
        // foreach ($arr as $key1 => $val1) {
        //    if($key1>0){
        //     //dd($key1);
        //     foreach ($arr as $key2 => $val2) {
        //         if($key2 < $arrLen-$key1){
        //             if($arr[$key2] > $arr[$key2+1]){
        //                 $temp = $arr[$key2+1];
        //                 $arr[$key2+1] = $arr[$key2];
        //                 $arr[$key2] = $arr[$key2+1];
        //             }
        //         }

        //     }
        //    }
        // }
    }
    return $arr;
}


//修改env
function modifyEnv(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

    $contentArray->transform(function ($item) use ($data){
        foreach ($data as $key => $value){
            if(str_contains($item, $key)){
                return $key . '=' . $value;
            }
        }
        return $item;
    });

    $content = implode($contentArray->toArray(), "\n");

    \File::put($envPath, $content);
}

/**
 * 指定位置插入字符串
 * @param $str  原字符串
 * @param $i    插入位置
 * @param $substr 插入字符串
 * @return string 处理后的字符串
 */
function insertToStr($str, $i, $substr){
    //指定插入位置前的字符串
    $startstr="";
    for($j=0; $j<$i; $j++){
        $startstr .= $str[$j];
    }

    //指定插入位置后的字符串
    $laststr="";
    for ($j=$i; $j<strlen($str); $j++){
        $laststr .= $str[$j];
    }

    //将插入位置前，要插入的，插入位置后三个字符串拼接起来
    $str = $startstr . $substr . $laststr;

    //返回结果
    return $str;
}


$key = 'wefwefewfewfw321651)(*&(&';
/**
 * 加密
 * @param  [type] $data [description]
 * @param  [type] $key  [description]
 * @return [type]       [description]
 */
function zcjy_encrypt($data, $key)  
{  
    $key    =   md5($key);  
    $x      =   0;  
    $len    =   strlen($data);  
    $l      =   strlen($key);  
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++)  
    {  
        if ($x == $l)   
        {  
            $x = 0;  
        }  
        $char .= $key{$x};  
        $x++;  
    }  
    for ($i = 0; $i < $len; $i++)  
    {  
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);  
    }  
    return base64_encode($str);  
}

/**
 * 解密
 * @param  [type] $data [description]
 * @param  [type] $key  [description]
 * @return [type]       [description]
 */
function zcjy_decrypt($data, $key)  
{  
    $key = md5($key);  
    $x = 0;  
    $data = base64_decode($data);  
    $len = strlen($data);  
    $l = strlen($key);  
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++)  
    {  
        if ($x == $l)   
        {  
            $x = 0;  
        }  
        $char .= substr($key, $x, 1);  
        $x++;  
    }  
    for ($i = 0; $i < $len; $i++)  
    {  
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))  
        {  
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));  
        }  
        else  
        {  
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));  
        }  
    }  
    return $str;  
}  



function des($str, $num){
        global $Briefing_Length; 
        mb_regex_encoding("UTF-8");     
        $Foremost = mb_substr($str, 0, $num); 
        $re = "<(\/?) 
    (P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|OBJECT|A|UL|OL|LI| 
    BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|SPAN)[^>]*(>?)"; 
        $Single = "/BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|BR/i";     

        $Stack = array(); $posStack = array(); 

        mb_ereg_search_init($Foremost, $re, 'i'); 

        while($pos = mb_ereg_search_pos()){ 
            $match = mb_ereg_search_getregs(); 

            if($match[1]==""){ 
                $Elem = $match[2]; 
                if(mb_eregi($Single, $Elem) && $match[3] !=""){ 
                    continue; 
                } 
                array_push($Stack, mb_strtoupper($Elem)); 
                array_push($posStack, $pos[0]);             
            }else{ 
                $StackTop = $Stack[count($Stack)-1]; 
                $End = mb_strtoupper($match[2]); 
                if(strcasecmp($StackTop,$End)==0){ 
                    array_pop($Stack); 
                    array_pop($posStack); 
                    if($match[3] ==""){ 
                        $Foremost = $Foremost.">"; 
                    } 
                } 
            } 
        } 

        $cutpos = array_shift($posStack) - 1;     
        $Foremost =  mb_substr($Foremost,0,$cutpos,"UTF-8"); 
        return strip_tags($Foremost); 
}

//截取内容中的图片
function get_content_img($text){   
    //取得所有img标签，并储存至二维数组 $match 中   
    //preg_match_all('/<img[^>]*>/i', $text, $match);  
    //preg_match_all('/<img((?!src).)*src[\s]*=[\s]*[\'"](?<src>[^\'"]*)[\'"]/i',$text,$match);
     preg_match_all('/(src)=("[^"]*")/i', $text, $matches);
    // $ret = array();
    // foreach($matches[1] as $i => $v) {
    //     $ret[$v] = $matches[2][$i];
    // } 
    $images_arr = $matches[0];
    $match_arr = [];
    if(count($images_arr)){
        foreach ($images_arr as $key => $value) {
            array_push($match_arr,substr($value,5));
        }   
    }
    return $match_arr;
    
}

/**
 * 计算两点地理坐标之间的距离
 * @param  Decimal $longitude1 起点经度
 * @param  Decimal $latitude1  起点纬度
 * @param  Decimal $longitude2 终点经度 
 * @param  Decimal $latitude2  终点纬度
 * @param  Int     $unit       单位 1:米 2:公里
 * @param  Int     $decimal    精度 保留小数位数
 * @return Decimal
 */
function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

    if(empty($longitude1) || empty($latitude1) || empty($longitude2) || empty($latitude2)){
        return '???';
    }

    $EARTH_RADIUS = 6370.996; // 地球半径系数
    $PI = 3.1415926;

    $radLat1 = $latitude1 * $PI / 180.0;
    $radLat2 = $latitude2 * $PI / 180.0;

    $radLng1 = $longitude1 * $PI / 180.0;
    $radLng2 = $longitude2 * $PI /180.0;

    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;

    $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
    $distance = $distance * $EARTH_RADIUS * 1000;

    if($unit==2){
        $distance = $distance / 1000;
    }

    return round($distance, $decimal);

}

/**
 * 获取商品信息
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function getProductById($id){
    return Product::find($id);
}

/**
 * 获取页面附件字段信息
 * @param  [type] $page [description]
 * @param  [type] $key  [description]
 * @return [type]       [description]
 */
function get_page_custom_value_by_key($page,$key){
    return Cache::remember('zcjy_custom_page_'.$key.'_'.$page->id, Config::get('web.cachetime'), function() use ($page,$key) {
        $pageItems = $page->pageItems();
        if (empty($pageItems->get())) {
            return '';
        } else {
            if (empty($pageItems->where('key', $key)->first())) {
                return '';
            } else {
                return $pageItems->where('key', $key)->first()->value;
            }
        }
    });
}

/**
 * 获取文章附件字段信息
 * @param  [type] $post [description]
 * @param  [type] $key  [description]
 * @return [type]       [description]
 */
function get_post_custom_value_by_key($post,$key){
    return Cache::remember('zcjy_custom_post_'.$key.'_'.$post->id, Config::get('web.cachetime'), function() use ($post,$key) {
        $postItems = $post->items();
        if (empty($postItems->get())) {
            return '';
        } else {
            if (empty($postItems->where('key', $key)->first())) {
                return '';
            } else {
                return $postItems->where('key', $key)->first()->value;
            }
        }
    });
}

/**
 * 获取文章的收藏状态
 * @param  [type] $product_id [description]
 * @return [type]             [description]
 */
function getCollectionStatus($product_id){
    $user = auth('web')->user();
    return $user->collections()->whereRaw('products.id = '.$product_id)->count();
}

//通过银行名字获取图片
function getBankImgByName($bank_name){

    $bankinfo = BankSets::where('name',$bank_name)->first();
    if(empty($bankinfo)){
        return null;
    }else{
        return $bankinfo->img;
    }
}

//优化分类选择
function varifiedCatName($cat_repo_obj){
    if(empty($cat_repo_obj)){
        return '请选择分类';
    }else{
        return $cat_repo_obj->name;
    }
}

//通过admin对象验证路由权限
function varifyAllRouteByAdminObj($admin,$uri){
    $roles=$admin->roles()->get();
    $status=false;
    if(!empty($roles)) {
        foreach ($roles as $item) {
            $perms = $item->perms()->where('name','like','%'.'*'.'%')->get();
            //dd($perms);
            if(!empty($perms)){
                foreach($perms as $perm){
                    //|| strpos($uri,substr($perm->name,0,strlen($perm->name)-5))!==false
                    if(strpos($uri,substr($perm->name,0,strlen($perm->name)-2))!==false){
                        $status=true;
                    }
                }
            }
        }
        return $status;
    }else{
        return false;
    }
}

//通过路由名验证当前登录管理员是否有权限
function varifyAdminPermByRouteName($route_name){
    $admin=Auth::guard('admin')->user();
    $status_perm=true;
    if (!$admin->can($route_name)) {
           // if(!varifyAllRouteByAdminObj($admin,$route_name)) {
                $status_perm=false;
           // }
    }
    return $status_perm;
}

//自动根据tid匹配功能分组或者返回功能个数
function autoMatchRoleGroupNameByTid($tid,$get_length=true){
    $group_func=Config::get('rolesgroupfunc');
    $match_attr=[];
    $length=1;
    foreach ($group_func as $item){
        if($item['tid']==$tid){
            array_push($match_attr,$item['word']);
            $length=$item['length'];
        }
    }
    if($get_length) {
        return $length;
    }else{
        return count($match_attr)?$match_attr[0]:'未命名';
    }
}


//根据pid获取上级地区的路由
function varifyPidToBackByPid($pid){
    $parent_cities=Cities::find($pid);
    if($parent_cities->level==1){
        return route('cities.index');
    }else{
        $back_cities=Cities::find($pid)->ParentCitiesObj;
        if(!empty($back_cities)) {
            return route('cities.child.index', [$back_cities->id]);
        }
    }
}

//自动匹配计算方式
function varifyFreightTypeByTypeId($type_id){
    if($type_id==0){
        return '件数';
    }elseif ($type_id==1){
        return '重量';
    }elseif ($type_id==2){
        return '体积';
    }
}

//根据地区id返回对应运费模板信息
function getFreightInfoByCitiesId($cities_id){
    $city=Cities::find($cities_id);
    if(!empty($city)) {
        $freigt_tem = $city->freightTems()->get();
        if (!empty($freigt_tem)) {
            $freigt_tem_arr = [];
            $i = 0;
            foreach ($freigt_tem as $item) {
                $freight_type = $item->pivot->freight_type;
                $freight_first_count = $item->pivot->freight_first_count;
                $the_freight = $item->pivot->the_freight;
                $freight_continue_count = $item->pivot->freight_continue_count;
                $freight_continue_price = $item->pivot->freight_continue_price;
                $freigt_tem_arr[$i] = ['name'=>$item->name,'use_default'=>$item->SystemDefault,'freight_type' => $freight_type, 'freight_first_count' => $freight_first_count, 'the_freight' => $the_freight, 'freight_continue_count' => $freight_continue_count, 'freight_continue_price' => $freight_continue_price];
                $i++;
            }
            return $freigt_tem_arr;
        } else {
            return null;
        }
    }else{
        return null;
    }
}

//根据菜单类型返回索引参数
function varifyOrderType($order_type_word){
    $str='?menu_type=';
    if($order_type_word=='秒杀订单'){
        $str .='1';
    }elseif($order_type_word=='拼团订单'){
        $str .='5';
    }elseif($order_type_word=='发货单'){
        $str .='6';
    }
    return $str;

}

//根据优惠券的状态参数返回详细文本
function varifyCouponStatus($status){
    if($status==0){
        return '立即使用';
    }elseif ($status==1){
        return '已冻结';
    }elseif ($status==2){
        return '已使用';
    }elseif ($status==3){
        return '已过期';
    }elseif ($status==4){
        return '已作废';
    }
}


/**
 * 根据ID获取城市信息
 * @param  [type] $cities_id [description]
 * @return [type]            [description]
 */
function getCitiesNameById($cities_id)
{
    $city=Cities::find($cities_id);
    if(!empty($city)) {
        return $city->name;
    }else{
        return null;
    }
}


function getUsersWhetherHaveCoupons($coupons_id){
    $user = auth('web')->user();
    return $user->coupons()->whereRaw('coupon_users.id = '.$coupons_id)->where('from_way', '手动领取')->count();

    // $coupons=auth('web')->user()->coupons()->get();
    // $status=false;
    // if(!empty($coupons)){
    //     foreach ($coupons as $item) {
    //         if ($item->id === $coupons_id) {
    //             $status = true;
    //         }
    //     }
    // }
    // return $status;
}

/**
 * 邮件设置
 * @param  [type] $mail_name [description]
 * @return [type]            [description]
 */
function autoVarifyMailName($mail_name){
    if($mail_name=='email_host'){
        return 'MAIL_HOST';
    }elseif ($mail_name=='email_port'){
        return 'MAIL_PORT';
    }elseif($mail_name=='email_username'){
        return 'MAIL_USERNAME';
    }elseif ($mail_name=='email_password'){
        return 'MAIL_PASSWORD';
    }elseif ($mail_name=='email_encrypt'){
        return 'MAIL_ENCRYPTION';
    }elseif ($mail_name=='order_notify_email'){
        return 'MAIL_ENCRYPTION';
    }
}

//库存报警
function varifyInventory($inventory){
    $inventory_warn=empty(getSettingValueByKey('inventory_warn'))?0:getSettingValueByKey('inventory_warn');
    if($inventory==-1){
        return '无限';
    }
    if($inventory<=$inventory_warn){
        return "<small class='label label-danger'>警</small>".$inventory;
    }else{
        return $inventory;
    }
}

/**
 * 营销活动状态
 * @param  [type] $prom_type [description]
 * @return [type]            [description]
 */
function varifyCuXiao($prom_type){
    if($prom_type==0 || empty($prom_type)){
        return '无';
    }elseif ($prom_type==1){
        return '秒杀抢购中';
    }elseif ($prom_type==2){
        return '团购中';
    }
    elseif ($prom_type==3){
        return '促销中';
    }
    elseif ($prom_type==4){
        return '订单促销中';
    }
    elseif ($prom_type==5){
        return '拼团中';

    }
}

/**
 * 验证是否展开
 * @return [int] [是否展开tools 0不展开 1展开]
 */
function varifyTools($input,$order=false){
    $tools=0;
    if(count($input)){
        $tools=1;
        if(array_key_exists('page', $input) && count($input)==1) {
            $tools = 0;
        }
        if($order){
            if(array_key_exists('menu_type', $input) && count($input)==1) {
                $tools = 0;
            }
        }
    }
    return $tools;
}

/**
 * 倒序分页显示
 * @parameter [object]
 * @return [array] [desc]
 */
function paginateToShow($obj,$attr="created_at",$sort='desc'){
    if(!empty($obj)){
      return  $obj->orderBy($attr,$sort)->paginate(defaultPage());
    }else{
        return [];
    }
}

/**
 * 倒序分页显示
 * @parameter [object]
 * @return [array] [desc]
 */
function descAndPaginateToShow($obj,$attr="created_at",$sort='desc'){
    if(!empty($obj)){
      return  $obj->orderBy($attr,$sort)->paginate(defaultPage());
    }else{
        return [];
    }
}

/**
 * 默认分页数量
 * @parameter []
 * @return [int] [每页显示数量]
 */
function defaultPage(){
    return empty(getSettingValueByKey('records_per_page')) ? 15 : getSettingValueByKey('records_per_page');
}


/**
 * 根据ID获取用户信息
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function user($id)
{
    return Cache::remember('user_'.$id, Config::get('web.cachetime'), function() use ($id) {
        return User::where('id', $id)->first();
    });
}


/**
 * 根据banner别名获取BANNER
 * @param  [type] $slug [description]
 * @return [type]       [description]
 */
function banners($slug)
{
    $bannerRepo = app('commonRepo')->bannerRepo();
    $banners = $bannerRepo->getBannerCached($slug);
    return $banners;
}

/**
 * 国家馆
 * @return [type] [description]
 */
function countries()
{
    $countryRepo = app('commonRepo')->countryRepo();
    return $countryRepo->countriesCached();
}

/** 
 * 一级分类
 */
function cat_level01()
{
    $categoryRepo = app('commonRepo')->categoryRepo();
    return $categoryRepo->getRootCategoriesCached();
}

/**
 * 二级分类
 * @param  [type] $parent_id [description]
 * @return [type]            [description]
 */
function cat_level02($parent_id)
{
    $categoryRepo = app('commonRepo')->categoryRepo();
    return $categoryRepo->getChildCategories($parent_id);
}

/**
 * 拼团商品
 */
function teamSale($skip, $take)
{
    return app('commonRepo')->teamSaleRepo()->getTeamSales($skip, $take);
}
/**
 * 秒杀商品
 */
function flashSale($skip, $take){
    return app('commonRepo')->flashSaleRepo()->salesBetweenTime($skip, $take);
}
/**
 * 商品
 */
function products($skip, $take)
{
    return app('commonRepo')->productRepo()->products($skip, $take);
}
/**
 * 新品
 */
function newProducts($skip, $take)
{
    return app('commonRepo')->productRepo()->newProducts($skip, $take);
}
/**
 * 促销商品
 * @param  [type] $skip [description]
 * @param  [type] $take [description]
 * @return [type]       [description]
 */
function prompProducts($skip, $take)
{
    return app('commonRepo')->productRepo()->productsOfCurPromp($skip, $take);
}
/**
 * 通知消息
 * @return [type] [description]
 */
function notices()
{
    return app('commonRepo')->noticeRepo()->notices();
}

function notice($id)
{
    return app('commonRepo')->noticeRepo()->notice($id);
}

/**
 * [为指定订单加上订单时间]
 * @param [type] $order_time [description]
 */
function addOrderTimeByStartTime($order_time){
    $add_hours = getSettingValueByKey('order_expire_time');
    $end_hours = Carbon::now();
    if(!empty($add_hours)){
        $end_hours =Carbon::parse($order_time)->addHours($add_hours);
    }
    return  $end_hours;
}

/**
 * 商店列表
 * @return [type] [description]
 */
function stores($skip = 0, $take = 18)
{
    return  app('commonRepo')->storeRepo()->stores($skip, $take);
}

function storeWithProducts($skip = 0, $take = 18)
{
    return  app('commonRepo')->storeRepo()->storesWithProducts($skip, $take);
}