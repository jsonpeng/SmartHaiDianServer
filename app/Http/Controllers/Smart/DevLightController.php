<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevLightRequest;
use App\Http\Requests\UpdateDevLightRequest;
use App\Repositories\DevLightRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevLightController extends AppBaseController
{
    /** @var  DevLightRepository */
    private $devLightRepository;

    public function __construct(DevLightRepository $devLightRepo)
    {
        $this->devLightRepository = $devLightRepo;
    }

    /**
     * Display a listing of the DevLight.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devLightRepository->pushCriteria(new RequestCriteria($request));
        $devLights = $this->devLightRepository->all();
        
        return view('dev_lights.index')
            ->with('devLights', $devLights);
    }

    /**
     * Show the form for creating a new DevLight.
     *
     * @return Response
     */
    public function create()
    {
        $Regions = app('common')->RegionRepo()->all();
        return view('dev_lights.create')
        ->with('Regions',$Regions)
        ->with('model_required',modelRequiredParam($this->devLightRepository));
    }

    /**
     * Store a newly created DevLight in storage.
     *
     * @param CreateDevLightRequest $request
     *
     * @return Response
     */
    public function store(CreateDevLightRequest $request)
    {
        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $devLight = $this->devLightRepository->create($input);

        Flash::success('添加设备成功.');

        return redirect(route('devLights.index'));
    }

    /**
     * Display the specified DevLight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devLight = $this->devLightRepository->findWithoutFail($id);

        if (empty($devLight)) {
            Flash::error('Dev Light not found');

            return redirect(route('devLights.index'));
        }

        return view('dev_lights.show')->with('devLight', $devLight);
    }

    /**
     * Show the form for editing the specified DevLight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devLight = $this->devLightRepository->findWithoutFail($id);

        if (empty($devLight)) {
            Flash::error('Dev Light not found');

            return redirect(route('devLights.index'));
        }
        $Regions = app('common')->RegionRepo()->all();
        return view('dev_lights.edit')
        ->with('devLight', $devLight)
        ->with('Regions',$Regions)
        ->with('model_required',modelRequiredParam($this->devLightRepository));
    }

    /**
     * Update the specified DevLight in storage.
     *
     * @param  int              $id
     * @param UpdateDevLightRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevLightRequest $request)
    {
        $devLight = $this->devLightRepository->findWithoutFail($id);
        // dd($devLight);
        if (empty($devLight)) {
            Flash::error('Dev Light not found');

            return redirect(route('devLights.index'));
        }

        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());
        // dd($input);
        $this->devLightRepository->model()::where('id',$id)->update($this->updateParam($input));

        Flash::success('更新设备成功.');

        return redirect(route('devLights.index'));
    }

    public function updateParam($input)
    {
        $param = [];
        $needParam = $this->devLightRepository->model()::$attribute;
        foreach ($input as $key => $value) 
        {
            if(in_array($key, $needParam))
            {
                $param[$key] = $value;
            }
        }
        return $param;
    }

    /**
     * Remove the specified DevLight from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devLight = $this->devLightRepository->findWithoutFail($id);

        if (empty($devLight)) {
            Flash::error('Dev Light not found');

            return redirect(route('devLights.index'));
        }

        $this->devLightRepository->delete($id);

        Flash::success('删除设备成功.');

        return redirect(route('devLights.index'));
    }
}
