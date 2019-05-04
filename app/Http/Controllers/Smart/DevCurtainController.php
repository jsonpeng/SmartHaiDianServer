<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevCurtainRequest;
use App\Http\Requests\UpdateDevCurtainRequest;
use App\Repositories\DevCurtainRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevCurtainController extends AppBaseController
{
    /** @var  DevCurtainRepository */
    private $devCurtainRepository;

    public function __construct(DevCurtainRepository $devCurtainRepo)
    {
        $this->devCurtainRepository = $devCurtainRepo;
    }

    /**
     * Display a listing of the DevCurtain.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devCurtainRepository->pushCriteria(new RequestCriteria($request));
        $devCurtains = $this->devCurtainRepository->all();

        return view('dev_curtains.index')
            ->with('devCurtains', $devCurtains);
    }

    /**
     * Show the form for creating a new DevCurtain.
     *
     * @return Response
     */
    public function create()
    {
        return view('dev_curtains.create')
        ->with('Regions',app('common')->RegionRepo()->all())
        ->with('model_required',modelRequiredParam($this->devCurtainRepository));
    }

    /**
     * Store a newly created DevCurtain in storage.
     *
     * @param CreateDevCurtainRequest $request
     *
     * @return Response
     */
    public function store(CreateDevCurtainRequest $request)
    {
        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $devCurtain = $this->devCurtainRepository->create($input);

        Flash::success('添加成功.');

        return redirect(route('devCurtains.index'));
    }

    /**
     * Display the specified DevCurtain.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devCurtain = $this->devCurtainRepository->findWithoutFail($id);

        if (empty($devCurtain)) {
            Flash::error('Dev Curtain not found');

            return redirect(route('devCurtains.index'));
        }

        return view('dev_curtains.show')->with('devCurtain', $devCurtain);
    }

    /**
     * Show the form for editing the specified DevCurtain.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devCurtain = $this->devCurtainRepository->findWithoutFail($id);

        if (empty($devCurtain)) {
            Flash::error('Dev Curtain not found');

            return redirect(route('devCurtains.index'));
        }

        return view('dev_curtains.edit')
        ->with('devCurtain', $devCurtain)
        ->with('Regions',app('common')->RegionRepo()->all())
        ->with('model_required',modelRequiredParam($this->devCurtainRepository));
    }

    /**
     * Update the specified DevCurtain in storage.
     *
     * @param  int              $id
     * @param UpdateDevCurtainRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevCurtainRequest $request)
    {
        $devCurtain = $this->devCurtainRepository->findWithoutFail($id);

        if (empty($devCurtain)) {
            Flash::error('Dev Curtain not found');

            return redirect(route('devCurtains.index'));
        }
        $input = app('common')->RegionRepo()->attachReginNameByInputId($request->all());

        $devCurtain = $this->devCurtainRepository->update($input, $id);

        Flash::success('更新成功.');

        return redirect(route('devCurtains.index'));
    }

    /**
     * Remove the specified DevCurtain from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devCurtain = $this->devCurtainRepository->findWithoutFail($id);

        if (empty($devCurtain)) {
            Flash::error('Dev Curtain not found');

            return redirect(route('devCurtains.index'));
        }

        $this->devCurtainRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('devCurtains.index'));
    }
}
