<?php
namespace App\Http\Controllers\Smart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//电表记录类
use App\Models\DevMeterRecord;
//气体传感器记录类
use App\Models\DevGasesRecord;
//环境传感器记录类
use App\Models\DevEnvRecord;
//空气净化器类
use App\Models\DevPurifierRecord;
//文章
use App\Models\Post;

class MainController extends Controller
{

	public function index()
	{
		$data = [
			#气体 传感器数据
			'sensor_gases' => $this->sensorGasesData(),
			#环境 传感器数据,
			'sensor_env'   => $this->sensorEnvData(),
			#电表数据
			'electric' 	   => $this->electricData(),
			#空气净化器数据
			'purifier'	   => $this->purifierData()
		];
		return zcjy_data($data);
	}


	public function post($id)
	{
		$post = Post::find($id);
		if(empty($post))
		{
			return redirect('/');
		}
		return view('front.post.index',compact('post'));
	}

	/**
	 * 气体 传感器数据
	 * @return [type] [description]
	 */
	private function sensorGasesData()
	{
		return DevGasesRecord::getSensor();
	}

	/**
	 * 环境 传感器数据
	 * @return [type] [description]
	 */
	private function sensorEnvData()
	{
		return DevEnvRecord::getEnv();
	}


	/**
	 * 电表信息
	 * @return [type] [description]
	 */
	private function electricData()
	{
		 return DevMeterRecord::getMeter();
	}

	private function purifierData()
	{
		return DevPurifierRecord::getRecord();
	}
}
