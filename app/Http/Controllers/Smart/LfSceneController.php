<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateLfSceneRequest;
use App\Http\Requests\UpdateLfSceneRequest;
use App\Repositories\LfSceneRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LfSceneController extends AppBaseController
{
    /** @var  LfSceneRepository */
    private $lfSceneRepository;

    public function __construct(LfSceneRepository $lfSceneRepo)
    {
        $this->lfSceneRepository = $lfSceneRepo;
    }

    /**
     * Display a listing of the LfScene.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lfSceneRepository->pushCriteria(new RequestCriteria($request));
        $lfScenes = \Smart::getAllLfScenes();

        return view('lf_scenes.index')
            ->with('lfScenes', $lfScenes);
    }

    /**
     * Show the form for creating a new LfScene.
     *
     * @return Response
     */
    public function create()
    {
        return view('lf_scenes.create');
    }

    /**
     * Store a newly created LfScene in storage.
     *
     * @param CreateLfSceneRequest $request
     *
     * @return Response
     */
    public function store(CreateLfSceneRequest $request)
    {
        $input = $request->all();

        $lfScene = $this->lfSceneRepository->create($input);

        Flash::success('Lf Scene saved successfully.');

        return redirect(route('lfScenes.index'));
    }

    /**
     * Display the specified LfScene.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lfScene = $this->lfSceneRepository->findWithoutFail($id);

        if (empty($lfScene)) {
            Flash::error('Lf Scene not found');

            return redirect(route('lfScenes.index'));
        }

        return view('lf_scenes.show')->with('lfScene', $lfScene);
    }

    /**
     * Show the form for editing the specified LfScene.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lfScene = $this->lfSceneRepository->findWithoutFail($id);

        if (empty($lfScene)) {
            Flash::error('Lf Scene not found');

            return redirect(route('lfScenes.index'));
        }

        return view('lf_scenes.edit')->with('lfScene', $lfScene);
    }

    /**
     * Update the specified LfScene in storage.
     *
     * @param  int              $id
     * @param UpdateLfSceneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLfSceneRequest $request)
    {
        $lfScene = $this->lfSceneRepository->findWithoutFail($id);

        if (empty($lfScene)) {
            Flash::error('Lf Scene not found');

            return redirect(route('lfScenes.index'));
        }

        $lfScene = $this->lfSceneRepository->update($request->all(), $id);

        Flash::success('Lf Scene updated successfully.');

        return redirect(route('lfScenes.index'));
    }

    /**
     * Remove the specified LfScene from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lfScene = $this->lfSceneRepository->findWithoutFail($id);

        if (empty($lfScene)) {
            Flash::error('Lf Scene not found');

            return redirect(route('lfScenes.index'));
        }

        $this->lfSceneRepository->delete($id);

        Flash::success('Lf Scene deleted successfully.');

        return redirect(route('lfScenes.index'));
    }
}
