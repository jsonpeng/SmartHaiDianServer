<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevElectricityMeterRequest;
use App\Http\Requests\UpdateDevElectricityMeterRequest;
use App\Repositories\DevElectricityMeterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevElectricityMeterController extends AppBaseController
{
    /** @var  DevElectricityMeterRepository */
    private $devElectricityMeterRepository;

    public function __construct(DevElectricityMeterRepository $devElectricityMeterRepo)
    {
        $this->devElectricityMeterRepository = $devElectricityMeterRepo;
    }

    /**
     * Display a listing of the DevElectricityMeter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devElectricityMeterRepository->pushCriteria(new RequestCriteria($request));
        $devElectricityMeters = $this->devElectricityMeterRepository->all();

        return view('dev_electricity_meters.index')
            ->with('devElectricityMeters', $devElectricityMeters);
    }

    /**
     * Show the form for creating a new DevElectricityMeter.
     *
     * @return Response
     */
    public function create()
    {
        return view('dev_electricity_meters.create');
    }

    /**
     * Store a newly created DevElectricityMeter in storage.
     *
     * @param CreateDevElectricityMeterRequest $request
     *
     * @return Response
     */
    public function store(CreateDevElectricityMeterRequest $request)
    {
        $input = $request->all();

        $devElectricityMeter = $this->devElectricityMeterRepository->create($input);

        Flash::success('Dev Electricity Meter saved successfully.');

        return redirect(route('devElectricityMeters.index'));
    }

    /**
     * Display the specified DevElectricityMeter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devElectricityMeter = $this->devElectricityMeterRepository->findWithoutFail($id);

        if (empty($devElectricityMeter)) {
            Flash::error('Dev Electricity Meter not found');

            return redirect(route('devElectricityMeters.index'));
        }

        return view('dev_electricity_meters.show')->with('devElectricityMeter', $devElectricityMeter);
    }

    /**
     * Show the form for editing the specified DevElectricityMeter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devElectricityMeter = $this->devElectricityMeterRepository->findWithoutFail($id);

        if (empty($devElectricityMeter)) {
            Flash::error('Dev Electricity Meter not found');

            return redirect(route('devElectricityMeters.index'));
        }

        return view('dev_electricity_meters.edit')->with('devElectricityMeter', $devElectricityMeter);
    }

    /**
     * Update the specified DevElectricityMeter in storage.
     *
     * @param  int              $id
     * @param UpdateDevElectricityMeterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevElectricityMeterRequest $request)
    {
        $devElectricityMeter = $this->devElectricityMeterRepository->findWithoutFail($id);

        if (empty($devElectricityMeter)) {
            Flash::error('Dev Electricity Meter not found');

            return redirect(route('devElectricityMeters.index'));
        }

        $devElectricityMeter = $this->devElectricityMeterRepository->update($request->all(), $id);

        Flash::success('Dev Electricity Meter updated successfully.');

        return redirect(route('devElectricityMeters.index'));
    }

    /**
     * Remove the specified DevElectricityMeter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devElectricityMeter = $this->devElectricityMeterRepository->findWithoutFail($id);

        if (empty($devElectricityMeter)) {
            Flash::error('Dev Electricity Meter not found');

            return redirect(route('devElectricityMeters.index'));
        }

        $this->devElectricityMeterRepository->delete($id);

        Flash::success('Dev Electricity Meter deleted successfully.');

        return redirect(route('devElectricityMeters.index'));
    }
}
