<?php

namespace App\Http\Controllers\Smart;

use App\Http\Requests\CreateChartDataRequest;
use App\Http\Requests\UpdateChartDataRequest;
use App\Repositories\ChartDataRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ChartDataController extends AppBaseController
{
    /** @var  ChartDataRepository */
    private $chartDataRepository;
    //指标类型
    private $chartIdx = [
        'water' => '用水量',
        'elec'  => '用电量',
        'gas'   => '天然气量',
        'cf_elec' => '厨房用电量',
        'kt_elec' => '客厅用电量',
        'sf_elec' => '书房用电量',
        'jk_elec' => '监控中心',
        'online_total' => '设备总数',
        'send_total'   => '发送请求数',
        'receive_total' => '接受请求数',
        'csld'          => '厂商联动',
        'sfld'          => '三方联动',
        'fault_rate'    => '设备故障'  
    ];
    //时间跨度
    private $timeSpan = [
        '0' => '小时',
        '1' => '按天',
        '2' => '按月'
    ];
    public function __construct(ChartDataRepository $chartDataRepo)
    {
        $this->chartDataRepository = $chartDataRepo;
    }

    /**
     * Display a listing of the ChartData.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->chartDataRepository->pushCriteria(new RequestCriteria($request));

        $input = $request->all();

        $chartDatas = $this->chartDataRepository->model()::where('id','>',0);

        if(isset($input['idx']))
        {
            $chartDatas = $chartDatas->where('idx',$input['idx']);
        }

        if(isset($input['time_span']) || array_key_exists('time_span', $input) && (int)($input['time_span']) == 0)
        {
            $chartDatas = $chartDatas->where('time_span',$input['time_span']);
        }

        $chartDatas = $chartDatas
        ->orderBy('record_date','desc')
        ->orderBy('record_time','desc')
        ->paginate(15);

        return view('chart_datas.index')
            ->with('chartDatas', $chartDatas)
            ->with('chartIdx',$this->chartIdx)
            ->with('timeSpan',$this->timeSpan)
            ->with('input',$input);
    }

    /**
     * Show the form for creating a new ChartData.
     *
     * @return Response
     */
    public function create()
    {
        return view('chart_datas.create')
            ->with('chartIdx',$this->chartIdx)
            ->with('timeSpan',$this->timeSpan)
            ->with('model_required',modelRequiredParam($this->chartDataRepository));
    }

    /**
     * Store a newly created ChartData in storage.
     *
     * @param CreateChartDataRequest $request
     *
     * @return Response
     */
    public function store(CreateChartDataRequest $request)
    {
        $input = $request->all();

        $devIdxDay = db('chart_data')->insert([
            'idx' => $input['idx'],
            'val' => $input['val'],
            'time_span' => $input['time_span'],
            'record_date' => $input['record_date'],
            'record_time' => $input['record_time'],
        ]);

        Flash::success('图表数据添加成功.');

        return redirect(route('chartDatas.index'));
    }

    /**
     * Display the specified ChartData.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chartData = $this->chartDataRepository->findWithoutFail($id);

        if (empty($chartData)) {
            Flash::error('Chart Data not found');

            return redirect(route('chartDatas.index'));
        }

        return view('chart_datas.show')->with('chartData', $chartData);
    }

    /**
     * Show the form for editing the specified ChartData.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chartData = $this->chartDataRepository->findWithoutFail($id);

        if (empty($chartData)) {
            Flash::error('Chart Data not found');

            return redirect(route('chartDatas.index'));
        }

        return view('chart_datas.edit')
        ->with('chartData', $chartData)
        ->with('chartIdx',$this->chartIdx)
        ->with('timeSpan',$this->timeSpan)
        ->with('model_required',modelRequiredParam($this->chartDataRepository));
    }

    /**
     * Update the specified ChartData in storage.
     *
     * @param  int              $id
     * @param UpdateChartDataRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChartDataRequest $request)
    {
        $chartData = $this->chartDataRepository->findWithoutFail($id);

        if (empty($chartData)) {
            Flash::error('Chart Data not found');

            return redirect(route('chartDatas.index'));
        }

        $chartData = $this->chartDataRepository->update($request->all(), $id);

        Flash::success('图表数据更新成功');

        return redirect(route('chartDatas.index'));
    }

    /**
     * Remove the specified ChartData from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $chartData = $this->chartDataRepository->findWithoutFail($id);

        if (empty($chartData)) {
            Flash::error('Chart Data not found');

            return redirect(route('chartDatas.index'));
        }

        $this->chartDataRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('chartDatas.index'));
    }
}
