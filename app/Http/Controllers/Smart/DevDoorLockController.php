<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevDoorLockRequest;
use App\Http\Requests\UpdateDevDoorLockRequest;
use App\Repositories\DevDoorLockRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevDoorLockController extends AppBaseController
{
    /** @var  DevDoorLockRepository */
    private $devDoorLockRepository;

    public function __construct(DevDoorLockRepository $devDoorLockRepo)
    {
        $this->devDoorLockRepository = $devDoorLockRepo;
    }

    /**
     * Display a listing of the DevDoorLock.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devDoorLockRepository->pushCriteria(new RequestCriteria($request));
        $devDoorLocks = $this->devDoorLockRepository->all();

        return view('dev_door_locks.index')
            ->with('devDoorLocks', $devDoorLocks);
    }

    /**
     * Show the form for creating a new DevDoorLock.
     *
     * @return Response
     */
    public function create()
    {
        return view('dev_door_locks.create')
        ->with('Regions',app('common')->RegionRepo()->all())
        ->with('model_required',modelRequiredParam($this->devDoorLockRepository));
    }

    /**
     * Store a newly created DevDoorLock in storage.
     *
     * @param CreateDevDoorLockRequest $request
     *
     * @return Response
     */
    public function store(CreateDevDoorLockRequest $request)
    {
        $input = $request->all();

        $devDoorLock = $this->devDoorLockRepository->create($input);

        Flash::success('添加成功.');

        return redirect(route('devDoorLocks.index'));
    }

    /**
     * Display the specified DevDoorLock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devDoorLock = $this->devDoorLockRepository->findWithoutFail($id);

        if (empty($devDoorLock)) {
            Flash::error('Dev Door Lock not found');

            return redirect(route('devDoorLocks.index'));
        }

        return view('dev_door_locks.show')->with('devDoorLock', $devDoorLock);
    }

    /**
     * Show the form for editing the specified DevDoorLock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devDoorLock = $this->devDoorLockRepository->findWithoutFail($id);

        if (empty($devDoorLock)) {
            Flash::error('Dev Door Lock not found');

            return redirect(route('devDoorLocks.index'));
        }

        return view('dev_door_locks.edit')
        ->with('devDoorLock', $devDoorLock)
        ->with('Regions',app('common')->RegionRepo()->all())
        ->with('model_required',modelRequiredParam($this->devDoorLockRepository));
    }

    /**
     * Update the specified DevDoorLock in storage.
     *
     * @param  int              $id
     * @param UpdateDevDoorLockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevDoorLockRequest $request)
    {
        $devDoorLock = $this->devDoorLockRepository->findWithoutFail($id);

        if (empty($devDoorLock)) {
            Flash::error('Dev Door Lock not found');

            return redirect(route('devDoorLocks.index'));
        }

        $devDoorLock = $this->devDoorLockRepository->update($request->all(), $id);

        Flash::success('更新成功.');

        return redirect(route('devDoorLocks.index'));
    }

    /**
     * Remove the specified DevDoorLock from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devDoorLock = $this->devDoorLockRepository->findWithoutFail($id);

        if (empty($devDoorLock)) {
            Flash::error('Dev Door Lock not found');

            return redirect(route('devDoorLocks.index'));
        }

        $this->devDoorLockRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('devDoorLocks.index'));
    }
}
