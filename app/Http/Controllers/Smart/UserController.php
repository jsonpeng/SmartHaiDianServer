<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));

        $input = $request->all();

        session(['redirectUrlUser'=>$request->fullUrl()]);

        $users = $this->userRepository->model()::where('id','>',0);

        if(isset($input['uuid']))
        {
            $users = $users->where('uuid','like','%'.$input['uuid'].'%');
        }

        if(isset($input['name']))
        {
            $users = $users->where('name','like','%'.$input['name'].'%');
        }

        $users = $users
        ->orderBy('created_at','desc')
        ->paginate(10);

        return view('users.index')
            ->with('users', $users)
            ->with('input',$input);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create')
        ->with('model_required',modelRequiredParam($this->userRepository))
        ->with('scenes',app('common')->DevSceneRepo()->orderBy('region_id','asc')->get())
        ->with('userPreferences',[]);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        // $input['uuid'] = md5($input['pwd']);
        $user = $this->userRepository->create($input);
        //设置门锁临时用户
        // \Smart::setTempDoorUser('create',$user);
        //更新用户偏好
        app('common')->PreferenceRepo()->actionUserPreferenceScene('create',$user->id,$request->get('scene_id'));

        Flash::success('新用户创建成功.');

        return redirect(session('redirectUrlUser'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(session('redirectUrlUser'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(session('redirectUrlUser'));
        }

        return view('users.edit')
        ->with('user', $user)
        ->with('model_required',modelRequiredParam($this->userRepository))
        ->with('scenes',app('common')->DevSceneRepo()->orderBy('region_id','asc')->get())
        ->with('userPreferences',app('common')->PreferenceRepo()->userPreferenceScenesArr($id));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(session('redirectUrlUser'));
        }
        $input = $request->all();

        if(strlen($input['pwd']) < 6)
        {
            return redirect(route('users.edit',$id))
                   ->withInput($input)
                   ->withErrors('密码不得少于6个字符');
        }

        // if($this->userRepository->model()::where('id','<>',$id)->where('pwd',$input['pwd'])->count())
        // {
        //     return redirect(route('users.edit',$id))
        //            ->withInput($input)
        //            ->withErrors('该密码已被使用过,请更换密码');
        // }

        // $input['uuid'] = md5($input['pwd']);
        $user = $this->userRepository->update($input, $id);

        //设置门锁临时用户
        // \Smart::setTempDoorUser('modify',$user);

        //更新用户偏好
         app('common')->PreferenceRepo()->actionUserPreferenceScene('update',$id,$request->get('scene_id'));

        Flash::success('更新成功.');

        return redirect(session('redirectUrlUser'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(session('redirectUrlUser'));
        }

        //设置门锁临时用户
        // \Smart::setTempDoorUser('delete',$user);
        //更新用户偏好
        app('common')->PreferenceRepo()->actionUserPreferenceScene('delete',$user->id);

        $this->userRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(session('redirectUrlUser'));
    }
}
