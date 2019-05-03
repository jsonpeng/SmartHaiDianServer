@extends('front.partial.base')

@section('css')

@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|我的交易单</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')


  <div class="container pt30 pb120">
     <div class="row">
        <!--左侧导航-->
        @include('front.auth.left_nav')

        <div class="col-sm-1">
        </div>
        <!--右侧导航-->
        <div class="col-sm-9">

          	<div class="notice">
          		<div class="common-title text-center">
          			<div class="text-ch pt30">我的交易单</div>
          			<h3 class="text-en">My Order</h3>
          			<div class="short-line"></div>
          		</div>

                <div class="content pb220">

                    <table class="table table-responsive table-bordered table-hover" id="houseJoins-table">
                        <thead>
                            <tr  class="{!! getSettingValueByKeyCache("name") !!}_table_thead">
                     
                            <th>支持小屋</th>
                      
                            <th>购买档位</th>
                            <th>购买数量</th>
                            <th>订单描述</th>

                            <th>合计支持金额</th>
                            <th>支付平台</th>
                            <th>支付状态</th>
                            <th>是否需要合同</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $houseJoin)
                          <?php $house =optional($houseJoin->house);?>
                            <tr class="{!! $houseJoin->TrClass !!}">
                  
                                <td><img src="{!! $house->image !!}"  style="max-width: 120px;height: auto;" /><br />{!! a_link($house->name,'/manyDetail/'.$house->id) !!}</td>
                      

                                <td>{!! $houseJoin->gear !!}</td>
                                <td>{!! $houseJoin->gear_num !!}</td>
                                <td>{!! $houseJoin->body !!}</td>

                                <td>{!! $houseJoin->price !!}</td>
                                <td>{!! $houseJoin->pay_platform !!}</td>
                                <td>{!! $houseJoin->pay_status !!}</td>
                                <td>{!! $houseJoin->hetong !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                      {!! $orders->appends('')->links() !!}
                    </div>

                </div>
                  
               
              
              </div>



          </div>
        </div>
    </div>
@endsection

@section('js')
 @include('front.auth.usercenter_js')
@endsection