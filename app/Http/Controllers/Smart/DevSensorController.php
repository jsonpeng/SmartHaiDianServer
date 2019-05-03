<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevSensorRequest;
use App\Http\Requests\UpdateDevSensorRequest;
use App\Repositories\DevSensorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevSensorController extends AppBaseController
{
    /** @var  DevSensorRepository */
    private $devSensorRepository;

    public function __construct(DevSensorRepository $devSensorRepo)
    {
        $this->devSensorRepository = $devSensorRepo;
    }

    /**
     * Display a listing of the DevSensor.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devSensorRepository->pushCriteria(new RequestCriteria($request));
        $devSensors = $this->devSensorRepository->all();

        return view('dev_sensors.index')
            ->with('devSensors', $devSensors);
    }

    /**
     * Show the form for creating a new DevSensor.
     *
     * @return Response
     */
    public function create()
    {
        return view('dev_sensors.create')
        ->with('Regions',app('common')->RegionRepo()->all())
        ->with('model_required',modelRequiredParam($this->devSensorRepository));
    }

    /**
     * Store a newly created DevSensor in storage.
     *
     * @param CreateDevSensorRequest $request
     *
     * @return Response
     */
    public function store(CreateDevSensorRequest $request)
    {
        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $devSensor = $this->devSensorRepository->create($input);

        Flash::success('添加传感器成功.');

        return redirect(route('devSensors.index'));
    }

    /**
     * Display the specified DevSensor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devSensor = $this->devSensorRepository->findWithoutFail($id);

        if (empty($devSensor)) {
            Flash::error('Dev Sensor not found');

            return redirect(route('devSensors.index'));
        }

        return view('dev_sensors.show')->with('devSensor', $devSensor);
    }

    /**
     * Show the form for editing the specified DevSensor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devSensor = $this->devSensorRepository->findWithoutFail($id);

        if (empty($devSensor)) {
            Flash::error('Dev Sensor not found');

            return redirect(route('devSensors.index'));
        }

        return view('dev_sensors.edit')
        ->with('devSensor', $devSensor)
        ->with('Regions',app('common')->RegionRepo()->all())
        ->with('model_required',modelRequiredParam($this->devSensorRepository));
    }

    /**
     * Update the specified DevSensor in storage.
     *
     * @param  int              $id
     * @param UpdateDevSensorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevSensorRequest $request)
    {
        $devSensor = $this->devSensorRepository->findWithoutFail($id);

        if (empty($devSensor)) {
            Flash::error('Dev Sensor not found');

            return redirect(route('devSensors.index'));
        }

        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $devSensor = $this->devSensorRepository->update($input, $id);

        Flash::success('更新传感器成功.');

        return redirect(route('devSensors.index'));
    }

    /**
     * Remove the specified DevSensor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devSensor = $this->devSensorRepository->findWithoutFail($id);

        if (empty($devSensor)) {
            Flash::error('Dev Sensor not found');

            return redirect(route('devSensors.index'));
        }

        $this->devSensorRepository->delete($id);

        Flash::success('删除传感器成功.');

        return redirect(route('devSensors.index'));
    }
}
