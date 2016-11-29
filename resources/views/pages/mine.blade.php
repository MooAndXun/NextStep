@extends('layouts.main')

@section('content')
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
          <p class="center">你今天共走了 8000 步</p>
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
          <p class="center">你昨晚共睡了7个小时</p>
        </div>
      </div>
    </div>
  </div>

  <div class="card list-card rank-card">
    <div class="card-content">
      <div class="card-title">步数排行</div>
      <p class="center">今天你的运动步数排在第 <b>1</b> 名</p>
    </div>
    <ul class="collection">
      <li class="collection-item collection-header">
        <div class="collection-col collection-col-2 user-col"></div>
        <div class="collection-col collection-col-2 count-col">步数</div>
        <div class="collection-col rank-col">排名</div>
      </li>
      <li class="collection-item">
        <div class="collection-col collection-col-2 user-col">
          <img src="/img/person-1.jpg" alt="" class="avatar avatar-small">
          <p>Arron Hunt</p>
        </div>
        <div class="collection-col collection-col-2 count-col">20010</div>
        <div class="collection-col rank-col">1</div>
      </li>
      <li class="collection-item">
        <div class="collection-col collection-col-2 user-col">
          <img src="/img/person-2.jpg" alt="" class="avatar avatar-small">
          <p>Arron Hunt</p>
        </div>
        <div class="collection-col collection-col-2 count-col">12210</div>
        <div class="collection-col rank-col">2</div>
      </li>
      <li class="collection-item">
        <div class="collection-col collection-col-2 user-col">
          <img src="/img/person-3.jpg" alt="" class="avatar avatar-small">
          <p>Arron Hunt</p>
        </div>
        <div class="collection-col collection-col-2 count-col">8000</div>
        <div class="collection-col rank-col">3</div>
      </li>
    </ul>
  </div>
@stop

@section('js')
  @parent
  <script src='/js/today.js'></script>
@stop