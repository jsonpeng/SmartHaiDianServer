<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevModelRequest;
use App\Http\Requests\UpdateDevModelRequest;
use App\Repositories\DevModelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevModelController extends AppBaseController
{
    /** @var  DevModelRepository */
    private $devModelRepository;

    public function __construct(DevModelRepository $devModelRepo)
    {
        $this->devModelRepository = $devModelRepo;
    }

    /**
     * Display a listing of the DevModel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devModelRepository->pushCriteria(new RequestCriteria($request));
        $devModels = $this->devModelRepository->all();

        return view('dev_models.index')
            ->with('devModels', $devModels);
    }

    /**
     * Show the form for creating a new DevModel.
     *
     * @return Response
     */
    public function create()
    {
        return view('dev_models.create')
        ->with('model_required',modelRequiredParam($this->devModelRepository));
    }

    /**
     * Store a newly created DevModel in storage.
     *
     * @param CreateDevModelRequest $request
     *
     * @return Response
     */
    public function store(CreateDevModelRequest $request)
    {
        $input = $request->all();

        $devModel = $this->devModelRepository->create($input);

        Flash::success('添加成功.');

        return redirect(route('devModels.index'));
    }

    /**
     * Display the specified DevModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devModel = $this->devModelRepository->findWithoutFail($id);

        if (empty($devModel)) {
            Flash::error('Dev Model not found');

            return redirect(route('devModels.index'));
        }

        return view('dev_models.show')->with('devModel', $devModel);
    }

    /**
     * Show the form for editing the specified DevModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devModel = $this->devModelRepository->findWithoutFail($id);

        if (empty($devModel)) {
            Flash::error('Dev Model not found');

            return redirect(route('devModels.index'));
        }

        return view('dev_models.edit')
        ->with('devModel', $devModel)
        ->with('model_required',modelRequiredParam($this->devModelRepository));
    }

    /**
     * Update the specified DevModel in storage.
     *
     * @param  int              $id
     * @param UpdateDevModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevModelRequest $request)
    {
        $devModel = $this->devModelRepository->findWithoutFail($id);

        if (empty($devModel)) {
            Flash::error('Dev Model not found');

            return redirect(route('devModels.index'));
        }

        $devModel = $this->devModelRepository->update($request->all(), $id);

        Flash::success('更新成功.');

        return redirect(route('devModels.index'));
    }

    /**
     * Remove the specified DevModel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devModel = $this->devModelRepository->findWithoutFail($id);

        if (empty($devModel)) {
            Flash::error('Dev Model not found');

            return redirect(route('devModels.index'));
        }

        $this->devModelRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('devModels.index'));
    }
}
