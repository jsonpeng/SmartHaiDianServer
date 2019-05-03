<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevSceneRequest;
use App\Http\Requests\UpdateDevSceneRequest;
use App\Repositories\DevSceneRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevSceneController extends AppBaseController
{
    /** @var  DevSceneRepository */
    private $devSceneRepository;

    public function __construct(DevSceneRepository $devSceneRepo)
    {
        $this->devSceneRepository = $devSceneRepo;
    }

    /**
     * Display a listing of the DevScene.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devSceneRepository->pushCriteria(new RequestCriteria($request));

        session(['rediredUrlScene'=>$request->fullUrl()]);

        $devScenes = $this->devSceneRepository
        ->orderBy('created_at','asc')
        ->paginate(15);

        return view('dev_scenes.index')
            ->with('devScenes', $devScenes);
    }

    /**
     * Show the form for creating a new DevScene.
     *
     * @return Response
     */
    public function create()
    {
        $Regions = app('common')->RegionRepo()->all();
        return view('dev_scenes.create')
        ->with('Regions',$Regions)
        ->with('model_required',modelRequiredParam($this->devSceneRepository));
    }

    /**
     * Store a newly created DevScene in storage.
     *
     * @param CreateDevSceneRequest $request
     *
     * @return Response
     */
    public function store(CreateDevSceneRequest $request)
    {
        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $devScene = $this->devSceneRepository->create($input);

        Flash::success('场景添加成功.');

        $this->devSceneRepository->setSceneSwitch($input['enabled'],$devScene);

        return redirect(session('rediredUrlScene'));
    }

    /**
     * Display the specified DevScene.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devScene = $this->devSceneRepository->findWithoutFail($id);

        if (empty($devScene)) {
            Flash::error('Dev Scene not found');

            return redirect(route('devScenes.index'));
        }

        return view('dev_scenes.show')->with('devScene', $devScene);
    }

    /**
     * Show the form for editing the specified DevScene.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devScene = $this->devSceneRepository->findWithoutFail($id);

        if (empty($devScene)) {
            Flash::error('Dev Scene not found');

            return redirect(route('devScenes.index'));
        }
        $Regions = app('common')->RegionRepo()->all();
        return view('dev_scenes.edit')
        ->with('devScene', $devScene)
        ->with('Regions',$Regions)
        ->with('model_required',modelRequiredParam($this->devSceneRepository));
    }

    /**
     * Update the specified DevScene in storage.
     *
     * @param  int              $id
     * @param UpdateDevSceneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevSceneRequest $request)
    {
        $devScene = $this->devSceneRepository->findWithoutFail($id);

        if (empty($devScene)) {
            Flash::error('Dev Scene not found');

            return redirect(route('devScenes.index'));
        }

        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $input['enabled'] = (int)$input['enabled'];
        
        // dd($input);
        $devScene->update($input);

        $this->devSceneRepository->setSceneSwitch($input['enabled'],$devScene);

        Flash::success('场景更新成功.');

        return redirect(session('rediredUrlScene'));
    }

    /**
     * Remove the specified DevScene from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devScene = $this->devSceneRepository->findWithoutFail($id);

        if (empty($devScene)) {
            Flash::error('Dev Scene not found');

            return redirect(route('devScenes.index'));
        }

        $this->devSceneRepository->delete($id);

        Flash::success('场景删除成功.');

        return redirect(route('devScenes.index'));
    }
}
