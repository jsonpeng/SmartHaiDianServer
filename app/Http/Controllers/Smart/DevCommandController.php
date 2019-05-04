<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateDevCommandRequest;
use App\Http\Requests\UpdateDevCommandRequest;
use App\Repositories\DevCommandRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevCommandController extends AppBaseController
{
    /** @var  DevCommandRepository */
    private $devCommandRepository;

    public function __construct(DevCommandRepository $devCommandRepo)
    {
        $this->devCommandRepository = $devCommandRepo;
    }

    /**
     * Display a listing of the DevCommand.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->devCommandRepository->pushCriteria(new RequestCriteria($request));

        session(['rediredUrlCommand'=>$request->fullUrl()]);

        $devCommands = $this->devCommandRepository->model()::
        where("id",">",0);

        $input = $request->all();

        if(isset($input["scene_id"]))
        {
            $devCommands = $devCommands->where('scene_id',$request->get('scene_id'));
        }

        $devCommands = $devCommands   
        ->orderBy('created_at','desc')
        ->paginate(15);

        return view('dev_commands.index')
            ->with('input',$input)
            ->with('devCommands', $devCommands);
    }

    /**
     * Show the form for creating a new DevCommand.
     *
     * @return Response
     */
    public function create()
    {
        $scenes = app('common')->DevSceneRepo()->all();
        $idx = $this->devCommandRepository->model()::$idx;
        $type = $this->devCommandRepository->model()::$type;
        return view('dev_commands.create')
                ->with('scenes',$scenes)
                ->with('idx',$idx)
                ->with('type',$type);
    }

    /**
     * Store a newly created DevCommand in storage.
     *
     * @param CreateDevCommandRequest $request
     *
     * @return Response
     */
    public function store(CreateDevCommandRequest $request)
    {
        $input = $request->all();

        $devCommand = $this->devCommandRepository->create($input);

        Flash::success('联动命令添加成功.');

        return $this->redirectVarify($input);
    }

    private function redirectVarify($input)
    {
        $redirectUrl = route('devCommands.index');
        if(isset($input['_scene_id']))
        {
            $redirectUrl .= '?scene_id='.$input['_scene_id']; 
        }
        return redirect($redirectUrl);
    }

    /**
     * Display the specified DevCommand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devCommand = $this->devCommandRepository->findWithoutFail($id);

        if (empty($devCommand)) {
            Flash::error('Dev Command not found');

            return redirect(route('devCommands.index'));
        }

        return view('dev_commands.show')->with('devCommand', $devCommand);
    }

    /**
     * Show the form for editing the specified DevCommand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devCommand = $this->devCommandRepository->findWithoutFail($id);

        if (empty($devCommand)) {
            Flash::error('Dev Command not found');

            return redirect(route('devCommands.index'));
        }
        $scenes = app('common')->DevSceneRepo()->all();
        $idx = $this->devCommandRepository->model()::$idx;
        $type = $this->devCommandRepository->model()::$type;
        return view('dev_commands.edit')
        ->with('devCommand', $devCommand)
        ->with('scenes',$scenes)
        ->with('idx',$idx)
        ->with('type',$type);
    }

    /**
     * Update the specified DevCommand in storage.
     *
     * @param  int              $id
     * @param UpdateDevCommandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevCommandRequest $request)
    {
        $devCommand = $this->devCommandRepository->findWithoutFail($id);

        if (empty($devCommand)) {
            Flash::error('Dev Command not found');

            return redirect(route('devCommands.index'));
        }
        $input = $request->all();

        $devCommand = $this->devCommandRepository->update($input, $id);

        Flash::success('联动命令更新成功.');
        return $this->redirectVarify($input);
    }

    /**
     * Remove the specified DevCommand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devCommand = $this->devCommandRepository->findWithoutFail($id);

        if (empty($devCommand)) {
            Flash::error('Dev Command not found');

            return redirect(route('devCommands.index'));
        }

        $this->devCommandRepository->delete($id);

        Flash::success('联动命令删除成功.');

        return redirect(session('rediredUrlCommand'));
    }
}
