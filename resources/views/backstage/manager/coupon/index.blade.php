@extends('backstage.manager.layouts.master')
@section('content')

    <style>
        .table {border: 1px solid black;}
        .table tr:nth-child(even) {background: #EDEDED}
        .table tr:nth-child(odd) {background: #FFFFFF}
    </style>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <font color="#000000" face="微軟正黑體">優惠券管理 <small>優惠券列表</small></font>
        </h1>
    </div>
</div>

<!-- /.row -->
<div class="row" style="margin-bottom: 20px; text-align:right">
    <div class="col-lg-12">
        <a href="{{ route('backstage.manager.coupon.create') }}" class="btn btn-success"><font color="#ffffff" face="微軟正黑體">新增優惠券</font></a>
    </div>
</div>

<!-- /.row -->
<font color="#000000" face="微軟正黑體" style="text-align: center">
<div class="row">
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="border:3px #9BA2AB solid;">
                <thead style="border:2px #9BA2AB solid;">
                    <tr style="background-color: lightgrey;">
                        <th width="80" style="text-align: center">優惠券名稱</th>
                        <th width="120" style="text-align: center">內容</th>
                        <th width="100" style="text-align: center">折扣金額</th>
                        <th width="100" style="text-align: center">最低消費<br>金額</th>
                        <th width="180" style="text-align: center">開始時間</th>
                        <th width="180" style="text-align: center">結束時間</th>
                        <th width="100" style="text-align: center">發放狀態</th>
                        <th width="100" style="text-align: center">發送優惠券</th>
                        <th width="100" style="text-align: center">已兌換<br>數量</th>
                        <th width="80" style="text-align: center">修改</th>
                        <th width="80" style="text-align: center">刪除</th>
                    </tr>
                </thead>
                <tbody style="border:3px #9BA2AB solid;">
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$coupon->title}}</td>
                        <td>{{$coupon->content}}</td>
                        <td>{{$coupon->discount}}</td>
                        <td>{{$coupon->lowestprice}}</td>
                        <td>{{$coupon->StartTime}}</td>
                        <td>{{$coupon->EndTime}}</td>
                        <td>@if($coupon->status ==0)
                                <strong>未發送</strong>
                            @elseif(($coupon->status==1))
                                <strong>已發送</strong>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary"><a href="" style="color:white"><strong>發送</strong></a></button>
                        </td>
                        <td>{{$coupon->count}}張</td>
                        <td>
                            @if($coupon->status==1)
                                <button class="btn btn-info" disabled><a href="{{route('backstage.manager.coupon.edit',$coupon->id)}}" style="text-decoration:none;color: white">修改</a></button>
                            @else
                                <button class="btn btn-info"><a href="{{route('backstage.manager.coupon.edit',$coupon->id)}}" style="text-decoration:none;color: white">修改</a></button>
                            @endif
                        </td>
                                    {{--<a href="{{ route('backstage.manager.coupon.edit',$coupon->id) }}" class="btn btn-info" style="text-decoration:none;">修改</a></td>--}}
                        {{--<td>--}}
                            {{--<form action="{{ route('backstage.manager.coupon.destroy', $coupon->id) }}" method="POST">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--<button  class="btn btn-danger">刪除</button>--}}
                            {{--</form>--}}
                        {{--</td>--}}
                        <td>
                            @if($coupon->status==1)
                                <form action="{{ route('backstage.manager.coupon.destroy', $coupon->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button  class="btn btn-danger" disabled>刪除</button>
                                </form>
                            @else
                                <form action="{{ route('backstage.manager.coupon.destroy', $coupon->id) }}" method="POST" onsubmit="return ConfirmDelete()">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button  class="btn btn-danger">刪除</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</font>

    <script>
        function ConfirmDelete()
        {
            var x = confirm("確定要刪除該優惠券嗎?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
<!-- /.row -->
@endsection
