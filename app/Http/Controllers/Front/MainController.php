<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MainController extends Controller
{

    //首页
    public function index(Request $request)
    { 
      return view('admin.banners.create');
    }

    //优秀作家 good_writer
    public function goodWriter(Request $request)
    {
        $writers = app('common')->goodWriters(0,100);
        $posts = app('common')->postRepo()->yanshenPosts();
        #底部广告
        $bottom_guanggao = app('common')->bannerRepo()->getCacheBanner('post_guanggao');
        return view('front.good_writer',compact('writers','posts','bottom_guanggao'));
    }

    /**
     * 个人中心
     */
    //个人登录
    public function authLogin(Request $request)
    {
        if(auth('web')->check()){
            return redirect('/user/center/index');
        }
        return view('front.auth.login');
    }

    //个人手机号快速注册
    public function authMobileReg(Request $request)
    {
        if(auth('web')->check()){
            return redirect('/user/center/index');
        }
        return view('front.auth.mobile_reg');
    }

    //忘记密码
    public function authForgetPwd(Request $request)
    {
         return view('front.auth.forget_pwd');
    }

    //个人中心
    public function authCenter(Request $request)
    {
        $user = auth('web')->user();
        //$joins = app('common')->houseJoinRepo()->userHouseJoins($user->id,'已支付',true);
        //$all_consume = app('common')->houseJoinRepo()->useAllConsume($user->id);
        return view('front.auth.usercenter',compact('user'));
    }

   //个人中心 - 账号安全
   public function authAccount(Request $request)
   {
     $user = optional(auth('web')->user());
     return view('front.auth.usercenter_account',compact('user'));
   }


   //投稿发布
    public function authPublishPost(Request $request)
    {
        $user = auth('web')->user();
        $cats = app('common')->categoryRepo()->getRootCatArray();
        // dd($cats);
        return view('front.auth.publish_post',compact('cats'));   
    }

    //实名认证管理
    public function authCerts(Request $request)
    {
        $user = auth('web')->user();
        $cert = app('common')->authCert($user);
        return view('front.auth.usercenter_certs',compact('cert'));   
    }

    //发起实名认证
    public function publishCerts(Request $request)
    {
        $type = $request->get('type');
        if(empty($type)){
          $type = '个人';
        }
        return view('front.auth.usercenter_create_certs',compact('type'));
    }

    //个人中心 -> 我的关注
    public function authAttention(Request $request)
    {
        $user = auth('web')->user();
        $posts = app('common')->userCollectPosts($user);
        return view('front.auth.usercenter_attention',compact('posts'));
    }

    public function authPublish(Request $request)
    {
        $user = auth('web')->user();
        $posts = app('common')->postRepo()->userPosts($user);
        return view('front.auth.usercenter_publish',compact('posts'));
    }

    //通知中心
    public function authNotices(Request $request)
    {
        $user = auth('web')->user();
        
        #设置所有消息已读
        app('notice')->setNoticeReaded($user);

        $notices = app('notice')->authNotices($user,true);
      
        return view('front.auth.usercenter_notice',compact('notices'));
    }


}