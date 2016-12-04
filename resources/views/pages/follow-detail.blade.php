@extends('layouts.main')

@section('content')
  <div class="card">
    <div class="card-content">
      <div class="card-header">{{$friend_username}} 的今日健康数据</div>
    </div>
  </div>

  <div class="card-group sport-card-group">
    <div class="sport-today">
      <div class="card sport-today-card">
        <div class="card-content">
          <h1 class="card-title">今日步数</h1>
        </div>
        <div class="card-data">
          <div id='step-data' style="height: 300px; width:300px"></div>
          <i class="material-icons large">directions_run</i>
        </div>
        <div class="card-content">
          <p class="center">你今天共走了 {{ $steps }} 步</p>
        </div>
      </div>
      <div class="card sport-today-card">
        <div class="card-content">
          <p class="card-title">今日睡眠</p>
        </div>
        <div class="card-data">
          <div id='sleep-data' style="height: 300px; width:300px"></div>
          <i class="material-icons large">hotel</i>
        </div>

        <div class="card-content">
          <p class="center">你昨晚共睡了{{ $sleep_hour }}个小时</p>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  @parent
  <script>var username = '{{$friend_username}}'</script>
  <script src='/js/today.js'></script>
@stop