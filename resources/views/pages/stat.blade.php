@extends('layouts.main')

@section('content')
  <div class="card-group">
    <div class="card">
      <ul class="tabs">
        <li class="tab"><a href="#">步数统计</a></li>
        <li class="tab"><a href="#">睡眠分析</a></li>
        {{--<li class="tab"><a href="#">心率统计</a></li>--}}
        {{--<li class="tab"><a href="#">指标分析</a></li>--}}
      </ul>
    </div>

    <div class="stat-line-card card">
      <div class="card-content">
        <p class="card-title">步数统计</p>
      </div>
      <ul class="tabs">
        <li class="tab view-tab" id="day-tab"><a href="javascript:void(0)">日视图</a></li>
        <li class="tab view-tab" id="week-tab"><a class="active" href="javascript:void(0)">周视图</a></li>
        <li class="tab view-tab" id="month-tab"><a href="javascript:void(0)">月视图</a></li>
      </ul>
      <div class="divider"></div>
      <div id="step-stat-chart" style="width: 700px; height: 400px"></div>

        {{--<div class="card-content">--}}
          {{--<ul class="data-group sum-data-group">--}}
            {{--<li class="data-item">--}}
              {{--<p class="data-item-name">步数</p>--}}
              {{--<p class="data-item-value">100020</p>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li class="data-item">--}}
              {{--<p class="data-item-name">活动时长</p>--}}
              {{--<p class="data-item-value">1时31分</p>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li class="data-item">--}}
              {{--<p class="data-item-name">里程</p>--}}
              {{--<p class="data-item-value">5.2公里</p>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li class="data-item">--}}
              {{--<p class="data-item-name">消耗</p>--}}
              {{--<p class="data-item-value">187千卡</p>--}}
            {{--</li>--}}
          {{--</ul>--}}
        {{--</div>--}}
    </div>
  </div>
@stop

@section('js')
  @parent
  <script src='/js/stat.js'></script>
@stop