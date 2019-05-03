<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Hash;
use Mail;
use Illuminate\Support\Facades\Input;

use App\Models\HouseBoard;
use App\Models\AttachHouseBoard;

use Cache;
use Log;

class AjaxController extends Controller
{

    //上传文件
    public function uploadFile(Request $request)
    {
        $file =  Input::file('file');
        return app('common')->uploadFiles($file);
    }

    /**
     *发送邮箱验证码
     */
    public function sendEmailCode(Request $request,$type='reg'){
            $email=$request->input('email');
            $code=rand(1000,9999);
            $name = empty(getSettingValueByKeyCache('company_name')) ? 'gol公司' : getSettingValueByKeyCache('company_name');
            if(!empty($email)){
                 if($type == 'reg'){
                      if(User::where('email',$email)->count()){
                        return zcjy_callback_data('该用邮箱已被注册,请重新换个邮箱',1);
                      }
                    //保存验证码到session中去
                    session()->put('email_code_'.$request->ip(),$code);
                  }
                  else{
                    session()->put('email_code_'.$type.'_'.$request->ip(),$code);
                  }
                
                  Mail::send('emails.index',['name'=>$name,'code'=>$code],function($message) use ($email,$name){ 
                    $to = $email;
                    $message ->to($to)->subject('【'.$name.'】邮箱验证码');
                  });
                return zcjy_callback_data('发送成功');
            }
            else{
            return zcjy_callback_data('请输入邮箱',1);
          }
    }

    //发送手机验证码
    public function sendMobileCode(Request $request)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,['mobile']);
        if($varify){
            return zcjy_callback_data($varify,1);
        }
        $type = 'reg';
        if(array_key_exists('type',$input) && !empty($input['type'])){
            $type = $input['type'];
        }
        $count = User::where('mobile',$input['mobile'])->count();
        if($type == 'reg'){
                #如果已经有用户注册过该手机号
                if($count)
                {
                    return zcjy_callback_data('该手机号已经被注册过',1);
                }
        }
        elseif($type == 'login'){
            #如果没有用户注册过该手机号
                if(!$count)
                {
                    return zcjy_callback_data('该手机号没有被注册过,请先完成注册后登陆',1);
                }
        }
    
        $code = app('common')->sendVerifyCode($input['mobile'],$type);

        return zcjy_callback_data($code);
    }

    //忘记密码找回手机号或者密码 发送验证码
    public function forgetSendCode(Request $request)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,'type,value');
        if($varify){
            return zcjy_callback_data($varify,1);
        }
        if($input['type'] == 'mobile'){
             if(!User::where('mobile',$input['value'])->count())
            {
                return zcjy_callback_data('该手机号未注册过',1);
            }
            $code = app('common')->sendVerifyCode($input['value']);
        }
        else{
            if(!User::where('email',$input['value'])->count())
            {
                return zcjy_callback_data('该邮箱未被注册过',1);
            }
          $email = $input['value']; 
          $code=rand(1000,9999);
          $name = empty(getSettingValueByKeyCache('company_name')) ? 'gol公司' : getSettingValueByKeyCache('company_name');
          Mail::send('emails.index',['name'=>$name,'code'=>$code],function($message) use ($email,$name){ 
            $to = $email;
            $message ->to($to)->subject('【'.$name.'】找回密码邮箱验证码');
          });
        session()->put('email_code_find_'.$email,$code);
        }
        return zcjy_callback_data($code);
    }

    //忘记密码找回手机号或者密码操作
    public function forgetPwdFindAction(Request $request)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,'type,value,code,newpassword');
        if($varify){
            return zcjy_callback_data($varify,1);
        }
        $user = null;
        #手机号
        if($input['type'] == 'mobile'){
            if(session('mobile_code_reg'.$input['value']) != $input['code']){
                return zcjy_callback_data('手机验证码错误',1);
            }
            $user = User::where('mobile',$input['value'])->first();
        }#邮箱
        else{
          if(session('email_code_find_'.$input['value']) != $input['code']){
               return zcjy_callback_data('邮箱验证码错误',1);
          }
           $user = User::where('email',$input['value'])->first();
        }

        if(empty($user)){
             return zcjy_callback_data('未知错误',1);
        }
        #修改密码
        $user->update(['password'=>Hash::make($input['newpassword'])]);
        #登陆
        auth('web')->login($user);

        return zcjy_callback_data('修改密码成功');
    }

    //手机号注册
    public function regMobile(Request $request)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,['mobile','mobile_code']);

        if($varify){
            return zcjy_callback_data($varify,1);
        }

        #如果已经有用户注册过该手机号
        if(User::where('mobile',$input['mobile'])->count())
        {
            return zcjy_callback_data('该手机号已经被注册过',1);
        }   

        #验证session
        if(session('mobile_code_reg'.$input['mobile']) != $input['mobile_code'])
        {
            return zcjy_callback_data('手机验证码错误',1);
        }

        #新建一个用户
        $user = User::create([
            'name'=>generateMobileUserName($input['mobile']),
            'mobile'=>$input['mobile'],
            'password'=>Hash::make($input['mobile'])
        ]);

        #并且把用户对象存到session中去
        session(['mobile_reg_user'.$request->ip()=>$user]);

        return zcjy_callback_data('注册成功,请继续完善更多信息使用');

    }

    //用户注册
    public function regUser(Request $request)
    {
        $input = $request->all();

        $varify = varifyInputParam($input,['mobile','code','password','re_password']);

        if($varify){
            return zcjy_callback_data($varify,1);
        }

        #验证session
        if(session('mobile_code_reg'.$input['mobile']) != $input['code'])
        {
            return zcjy_callback_data('手机验证码错误',1);
        }

        #验证重复密码
        if($input['password'] != $input['re_password'])
        {
           return zcjy_callback_data('两次密码输入不一致',1);
        }

        if(User::where('mobile',$input['mobile'])->count()){
            return zcjy_callback_data('该手机号已经被注册过',1);
        }

        $input['password'] = Hash::make($input['password']);
        
        $input['nickname'] = generateMobileUserName($input['mobile']);

        #新建用户
        $user = User::create($input);

        #登录下
        auth('web')->login($user);

        return zcjy_callback_data('注册用户成功');
    }

    //更新用户接口
    public function updateUserApi(Request $request)
    {
        $input = $request->all();

        $user = auth('web')->user();
        // if(array_key_exists('head_image', $input)){
        //     if(empty($input['head_image'])){
        //         return zcjy_callback_data('请先上传选择图片',1);
        //     }
        // }
        
        if(array_key_exists('password',$input)){
            $input['password'] = Hash::make($input['password']);
        }

        if(array_key_exists('nickname',$input) && $user->nickname != $input['nickname'])
        {
            $input['update_nickname_time'] = 1;
             app('notice')->sendNoticeToUser($user->id,'您的昵称已经修改过一次,后期将无法继续修改!');
        }

        $user->update($input);
        return zcjy_callback_data('更新成功');
    }

    //用户登陆
    public function loginUser(Request $request)
    {
        $input = $request->all();
        if(!isset($input['type'])){
            return zcjy_callback_data('未知错误',1);
        }
        #手机号加密码登录
        if($input['type'] == 'pwd'){
            $varify = varifyInputParam($input,['name','password']);
            if($varify){
                return zcjy_callback_data($varify,1);
            }
            $name_user = User::where('name',$input['name'])->first();
            /**
             * 通过用户名或者邮箱都可以登陆
             */
            #用户名
            if(!empty($name_user)){
                if(!Hash::check($input['password'],$name_user->password)){
                    return zcjy_callback_data('密码输入错误',1);
                }
                auth('web')->login($name_user);
                $this->updateUserInfo($name_user,$request);
                return zcjy_callback_data('登陆成功');
            }
            #手机号
            $mobile_user = User::where('mobile',$input['name'])->first();
            if(!empty($mobile_user)){
                if(!Hash::check($input['password'],$mobile_user->password)){
                    return zcjy_callback_data('密码输入错误',1);
                }
                auth('web')->login($mobile_user);
                $this->updateUserInfo($mobile_user,$request);
                return zcjy_callback_data('登陆成功');
            }

            if(empty($name_user) || empty($mobile_user)){
                return zcjy_callback_data('账号或者密码错误',1);
            }
        }#手机号加验证码登陆
        elseif($input['type'] == 'code'){
            $varify = varifyInputParam($input,['mobile','code']);
            if($varify){
                return zcjy_callback_data($varify,1);
            }
            #手机号
            $mobile_user = User::where('mobile',$input['mobile'])->first();
            if(empty($mobile_user)){
                return zcjy_callback_data('该手机号未注册,请先完成注册',1);
            }
            #验证session
            if(session('mobile_code_login'.$input['mobile']) != $input['code'])
            {
                return zcjy_callback_data('手机验证码错误',1);
            }
            auth('web')->login($mobile_user);
            $this->updateUserInfo($mobile_user,$request);
            return zcjy_callback_data('登陆成功');
        }
    }

    //更新用户信息 上次ip和上次登录时间
    private function updateUserInfo($user,$request){
        $user->update([
            'last_login' => Carbon::now(),
            'last_ip' => $request->ip()
        ]);
    }

    //退出当前用户
    public function logoutUser(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        return zcjy_callback_data('退出成功');
    }

    //管理员给单个用户发通知消息
    public function sendOneUserNoticeAdmin(Request $request,$user_id)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,['content']);
        if($varify){
            return zcjy_callback_data($varify,1);
        }
        app('notice')->sendNoticeToUser($user_id,$input['content']);
        return zcjy_callback_data('发送成功');
    }

    //用户给单个用户发私信
    public function sendOneUserNoticeSiXin(Request $request,$user_id)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,['content']);
        if($varify){
            return zcjy_callback_data($varify,1);
        }
        app('notice')->sendNoticeToUser($user_id,$input['content'],auth('web')->user());
        return zcjy_callback_data('发送成功');
    }



    //给所有用户发通知消息
    public function sendAllUserNotice(Request $request)
    {
        $input = $request->all();
        $varify = varifyInputParam($input,['content']);
        if($varify){
            return zcjy_callback_data($varify,1);
        }
        app('notice')->sendNoticeToAllUser($input['content']);
        return zcjy_callback_data('发送成功');
    }

    //设置单条通知消息为已读
    public function setNoticeReaded(Request $request,$id)
    {
        app('notice')->setNoticeReadById($id);
        return zcjy_callback_data('已读成功');
    }

  
    /**
     * 发起实名认证
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function certsPublish(Request $request){
        return app('common')->certsRepo()->saveUserCert(auth('web')->user(),$request->all());
    }

    // 发起小屋 关注/取消关注
    public function attentionHouses(Request $request,$house_id)
    {
        $user = auth('web')->user();
        return app('common')->attentionHouses($user->id,$house_id);
    }

    //发起gol 关注/取消关注
    public function attentionGol(Request $request,$gol_id)
    {
        $user = auth('web')->user();
        return app('common')->attentionGol($user->id,$gol_id);
    }

    //发布小屋评论
    public function publishHouseComment(Request $request)
    {
         $input = $request->all();
         $user = auth('web')->user();
         if(!array_key_exists('content',$input) || array_key_exists('content',$input) && empty($input['content'])){
            return zcjy_callback_data('请输入留言内容',1);
         }
         $input['user_id'] = $user->id;
         #普通留言 没有回复人
         if(!array_key_exists('reply_user_id',$input)){
               HouseBoard::create([
                    'user_id'=>$input['user_id'],
                    'content'=>$input['content'],
                    'house_id'=>$input['house_id'],
                    'type'=>$input['type']
               ]);
             
         }
         #待回复的留言 回复已经发过的留言
         else{
                $comment = AttachHouseBoard::create([
                        'content' => $input['content'],
                        'message_id' => $input['message_id'],
                        'user_id' => $input['user_id'],
                        'reply_user_id' => $input['reply_user_id']
                ]);
                #给回复人通知
                app('notice')->sendUserNotice($input['reply_user_id'],$input['user_id'],'board','回复',['type'=>1,'comment_id'=>$comment->id]);
        }

        return zcjy_callback_data('发起留言成功');
    }

    //解绑微信号码
    public function unbindWeixin(Request $request){
        $user = auth('web')->user();
        $user->update(['openid'=>'']);
        return zcjy_callback_data('解绑成功');
    }

    //修改手机号绑定
    public function editMobileBind(Request $request){
        $input = $request->all();
        $user = auth('web')->user();

        if($input['type'] == 'edit'){

            #验证字段
            $varify = varifyInputParam($input,'code,newmobile,entermobile');

            if($varify){
                return zcjy_callback_data($varify,1);
            }   

        
            #验证码验证
            if(session('mobile_code_edit_mobile'.$user->mobile) != $input['code']){
                    return zcjy_callback_data('验证码错误',1);
            }
        }
        elseif($input['type'] == 'bind'){
            #验证字段
            $varify = varifyInputParam($input,'newmobile,entermobile');

            if($varify){
                return zcjy_callback_data($varify,1);
            } 
        }

        if($input['newmobile'] != $input['entermobile']){
            return zcjy_callback_data('两次手机号输入不一致',1);
        }

        if(User::where('mobile',$input['newmobile'])->count()){
            return zcjy_callback_data('该手机号已经被注册过',1);
        }

        $user->update(['mobile'=>$input['newmobile']]);
        
        return zcjy_callback_data('修改成功');
    }


    //用户发布文章
    public function publishPost(Request $request){

       return app('common')->postRepo()->userPublishPost($request->all(),auth('web')->user());
       
    }


    //开始二维码扫码操作
    public function startErweimaScan(Request $request)
    {
        //session(['ip_scan'.$request->ip()=>'wait scan']);
        Cache::put('ip_scan'.$request->ip(), 'wait scan',1);

        $erweima_param = $request->root().'/weixin_auth?ip='.$request->ip();
       
        return zcjy_callback_data(app('common')->generateErweima($request,$erweima_param));
    }

    //询问二维码状态
    public function askScanErweimaResult(Request $request)
    {
        $scan_result = Cache::get('ip_scan'.$request->ip());

        if(is_numeric($scan_result)){
            $user = User::find($scan_result);
            if(!empty($user)){
                auth('web')->login($user);
                $this->updateUserInfo($user,$request);
                $scan_result = 'login success';
            }
        }
        return zcjy_callback_data($scan_result);
    }


    //收藏文章
    public function actionCollectPost(Request $request,$post_id)
    {
        $user = auth('web')->user();
        return app('common')->actionAttentionPost($user,$post_id);
    }

    //设置为优秀作家    
    public function setGoodWriter(Request $request,$id)
    {
        $user = User::find($id);

        if(!empty($user)){
            $good_writer = 0;
            if(!$user->good_writer){
                $good_writer = 1;
            }
            $user->update(['good_writer'=>$good_writer]);
        }
        return zcjy_callback_data('设置成功');
    }

    //删除通知消息
    public function deleteNoticeAction(Request $request,$notice_id)
    {

        return app('common')->noticesRepo()->deleteNotice($notice_id);
        
    }
    
    public function likeOrDisPost(Request $request,$post_id)
    {
        $input = $request->all();
        #验证字段
        $varify = varifyInputParam($input,'type');

        if($varify){
            return zcjy_callback_data($varify,1);
        }

        $post = app('common')->postRepo()->findWithoutFail($post_id);

        if(empty($post)){
            return zcjy_callback_data('没有找到该条快讯!',1);
        }

        if($input['type'] == 'like'){
            $post->update(['like'=>$post->like+1]);
        }
        elseif($input['type'] == 'dislike'){
            $post->update(['dislike'=>$post->dislike+1]);
        }
        \Artisan::call('cache:clear');
        return zcjy_callback_data('操作成功');
    }

    //获取子分类列表
    public function getChildCats(Request $request,$cat_id)
    {
        return zcjy_callback_data(app('common')->categoryRepo()->getCacheChildCats($cat_id));
    }

    //下载图
    public function downloadImg(Request $request)
    {
        $input = $request->all();
        $rate = 60;
        if(array_key_exists('rate',$input) && !empty($input['rate']) && is_numeric($input['rate'])){
            $rate = $input['rate'];
        }
        return app('common')->downloadImage($request->get('url'),$rate);
    }
    

}