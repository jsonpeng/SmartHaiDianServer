<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateGatewayDevRequest;
use App\Http\Requests\UpdateGatewayDevRequest;
use App\Repositories\GatewayDevRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GatewayDevController extends AppBaseController
{
    /** @var  GatewayDevRepository */
    private $gatewayDevRepository;

    public function __construct(GatewayDevRepository $gatewayDevRepo)
    {
        $this->gatewayDevRepository = $gatewayDevRepo;
    }

    /**
     * Display a listing of the GatewayDev.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gatewayDevRepository->pushCriteria(new RequestCriteria($request));
        $gatewayDevs = collect(\Smart::getAllCurrentDevices())->groupBy('devtype');
        //->groupBy('devtype');
        // dd($gatewayDevs);
        return view('gateway_devs.index')
            ->with('gatewayDevs', $gatewayDevs);
    }

    /**
     * Show the form for creating a new GatewayDev.
     *
     * @return Response
     */
    public function create()
    {
        return view('gateway_devs.create');
    }

    /**
     * Store a newly created GatewayDev in storage.
     *
     * @param CreateGatewayDevRequest $request
     *
     * @return Response
     */
    public function store(CreateGatewayDevRequest $request)
    {
        $input = $request->all();

        $gatewayDev = $this->gatewayDevRepository->create($input);

        Flash::success('Gateway Dev saved successfully.');

        return redirect(route('gatewayDevs.index'));
    }

    /**
     * Display the specified GatewayDev.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gatewayDev = $this->gatewayDevRepository->findWithoutFail($id);

        if (empty($gatewayDev)) {
            Flash::error('Gateway Dev not found');

            return redirect(route('gatewayDevs.index'));
        }

        return view('gateway_devs.show')->with('gatewayDev', $gatewayDev);
    }

    /**
     * Show the form for editing the specified GatewayDev.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gatewayDev = $this->gatewayDevRepository->findWithoutFail($id);

        if (empty($gatewayDev)) {
            Flash::error('Gateway Dev not found');

            return redirect(route('gatewayDevs.index'));
        }

        return view('gateway_devs.edit')->with('gatewayDev', $gatewayDev);
    }

    /**
     * Update the specified GatewayDev in storage.
     *
     * @param  int              $id
     * @param UpdateGatewayDevRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGatewayDevRequest $request)
    {
        $gatewayDev = $this->gatewayDevRepository->findWithoutFail($id);

        if (empty($gatewayDev)) {
            Flash::error('Gateway Dev not found');

            return redirect(route('gatewayDevs.index'));
        }

        $gatewayDev = $this->gatewayDevRepository->update($request->all(), $id);

        Flash::success('Gateway Dev updated successfully.');

        return redirect(route('gatewayDevs.index'));
    }

    /**
     * Remove the specified GatewayDev from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gatewayDev = $this->gatewayDevRepository->findWithoutFail($id);

        if (empty($gatewayDev)) {
            Flash::error('Gateway Dev not found');

            return redirect(route('gatewayDevs.index'));
        }

        $this->gatewayDevRepository->delete($id);

        Flash::success('Gateway Dev deleted successfully.');

        return redirect(route('gatewayDevs.index'));
    }
}
