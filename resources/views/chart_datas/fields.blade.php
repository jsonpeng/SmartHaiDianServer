<!-- Idx Field -->
<div class="form-group col-sm-12">
    {!! Form::label('idx', '指标类型:') !!}
    <select name="idx" class="form-control">
        @foreach($chartIdx as $key => $item)
            <option value="{!! $key !!}" @if(isset($chartData) && $chartData->idx == $key) selected="selected" @endif>{!! $item !!}</option>
        @endforeach
    </select>
</div>

<!-- Desc Field -->
<div class="form-group col-sm-12">
    {!! Form::label('desc', '描述:') !!}
    {!! Form::text('desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Val Field -->
<div class="form-group col-sm-12">
    {!! Form::label('val', '取值:') !!}
    {!! Form::text('val', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Span Field -->
<div class="form-group col-sm-12" >
    {!! Form::label('time_span', '时间跨度:') !!}
    <select name="time_span" class="form-control">
        @foreach($timeSpan as $key => $item)
            <option value="{!! $key !!}" @if(isset($chartData) && $chartData->time_span == $key) selected="selected" @endif>{!! $item !!}</option>
        @endforeach
    </select>
</div>

<!-- Record Date Field -->
<div class="form-group col-sm-12 record_date" style="display: block;">
    {!! Form::label('record_date', '记录时间(年月日):') !!}
    {!! Form::text('record_date', null, ['class' => 'form-control','id'=>'record_date']) !!}
</div>

<!-- Record Time Field -->
<div class="form-group col-sm-12 record_time" style="display: block;">
    {!! Form::label('record_time', '记录时间(年月日小时):') !!}
    {!! Form::text('record_time', null, ['class' => 'form-control','id'=>'record_time']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('chartDatas.index') !!}" class="btn btn-default">返回</a>
</div>
