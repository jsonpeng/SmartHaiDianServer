<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateGatewayRequest;
use App\Http\Requests\UpdateGatewayRequest;
use App\Repositories\GatewayRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GatewayController extends AppBaseController
{
    /** @var  GatewayRepository */
    private $gatewayRepository;

    public function __construct(GatewayRepository $gatewayRepo)
    {
        $this->gatewayRepository = $gatewayRepo;
    }

    /**
     * Display a listing of the Gateway.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gatewayRepository->pushCriteria(new RequestCriteria($request));
        $gateways = \Smart::getAllGatewaies();

        return view('gateways.index')
            ->with('gateways', $gateways);
    }

    /**
     * Show the form for creating a new Gateway.
     *
     * @return Response
     */
    public function create()
    {
        return view('gateways.create');
    }

    /**
     * Store a newly created Gateway in storage.
     *
     * @param CreateGatewayRequest $request
     *
     * @return Response
     */
    public function store(CreateGatewayRequest $request)
    {
        $input = $request->all();

        $gateway = $this->gatewayRepository->create($input);

        Flash::success('Gateway saved successfully.');

        return redirect(route('gateways.index'));
    }

    /**
     * Display the specified Gateway.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gateway = $this->gatewayRepository->findWithoutFail($id);

        if (empty($gateway)) {
            Flash::error('Gateway not found');

            return redirect(route('gateways.index'));
        }

        return view('gateways.show')->with('gateway', $gateway);
    }

    /**
     * Show the form for editing the specified Gateway.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gateway = $this->gatewayRepository->findWithoutFail($id);

        if (empty($gateway)) {
            Flash::error('Gateway not found');

            return redirect(route('gateways.index'));
        }

        return view('gateways.edit')->with('gateway', $gateway);
    }

    /**
     * Update the specified Gateway in storage.
     *
     * @param  int              $id
     * @param UpdateGatewayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGatewayRequest $request)
    {
        $gateway = $this->gatewayRepository->findWithoutFail($id);

        if (empty($gateway)) {
            Flash::error('Gateway not found');

            return redirect(route('gateways.index'));
        }

        $gateway = $this->gatewayRepository->update($request->all(), $id);

        Flash::success('Gateway updated successfully.');

        return redirect(route('gateways.index'));
    }

    /**
     * Remove the specified Gateway from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gateway = $this->gatewayRepository->findWithoutFail($id);

        if (empty($gateway)) {
            Flash::error('Gateway not found');

            return redirect(route('gateways.index'));
        }

        $this->gatewayRepository->delete($id);

        Flash::success('Gateway deleted successfully.');

        return redirect(route('gateways.index'));
    }
}
