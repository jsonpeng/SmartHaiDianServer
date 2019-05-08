<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevIdxDayRequest;
use App\Http\Requests\UpdateDevIdxDayRequest;
use App\Repositories\DevIdxDayRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevIdxDayController extends AppBaseController
{
    /** @var  DevIdxDayRepository */
    private $devIdxDayRepository;

    public function __construct(DevIdxDayRepository $devIdxDayRepo)
    {
        $this->devIdxDayRepository = $devIdxDayRepo;
    }

    /**
     * Display a listing of the DevIdxDay.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devIdxDayRepository->pushCriteria(new RequestCriteria($request));
        $devIdxDays = $this->devIdxDayRepository
        ->orderBy('record_at','asc')
        ->paginate(15);

        return view('dev_idx_days.index')
            ->with('devIdxDays', $devIdxDays);
    }

    /**
     * Show the form for creating a new DevIdxDay.
     *
     * @return Response
     */
    public function create()
    {
        return view('dev_idx_days.create')
        ->with('model_required',modelRequiredParam($this->devIdxDayRepository));
    }

    /**
     * Store a newly created DevIdxDay in storage.
     *
     * @param CreateDevIdxDayRequest $request
     *
     * @return Response
     */
    public function store(CreateDevIdxDayRequest $request)
    {
        $input = $request->all();



        $devIdxDay = db('dev_idx_day')->insert([
            'idx' => $input['idx'],
            'val' => $input['val'],
            'record_at' => $input['record_at']
        ]);

        Flash::success('添加成功.');

        return redirect(route('devIdxDays.index'));
    }

    /**
     * Display the specified DevIdxDay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devIdxDay = $this->devIdxDayRepository->findWithoutFail($id);

        if (empty($devIdxDay)) {
            Flash::error('Dev Idx Day not found');

            return redirect(route('devIdxDays.index'));
        }

        return view('dev_idx_days.show')->with('devIdxDay', $devIdxDay);
    }

    /**
     * Show the form for editing the specified DevIdxDay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devIdxDay = $this->devIdxDayRepository->findWithoutFail($id);

        if (empty($devIdxDay)) {
            Flash::error('Dev Idx Day not found');

            return redirect(route('devIdxDays.index'));
        }

        return view('dev_idx_days.edit')
        ->with('devIdxDay', $devIdxDay)
        ->with('model_required',modelRequiredParam($this->devIdxDayRepository));
    }

    /**
     * Update the specified DevIdxDay in storage.
     *
     * @param  int              $id
     * @param UpdateDevIdxDayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevIdxDayRequest $request)
    {
        $devIdxDay = $this->devIdxDayRepository->findWithoutFail($id);

        if (empty($devIdxDay)) {
            Flash::error('Dev Idx Day not found');

            return redirect(route('devIdxDays.index'));
        }

        $devIdxDay->update($request->all());

        Flash::success('更新成功.');

        return redirect(route('devIdxDays.index'));
    }

    /**
     * Remove the specified DevIdxDay from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devIdxDay = $this->devIdxDayRepository->findWithoutFail($id);

        if (empty($devIdxDay)) {
            Flash::error('Dev Idx Day not found');

            return redirect(route('devIdxDays.index'));
        }

        $this->devIdxDayRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('devIdxDays.index'));
    }
}
