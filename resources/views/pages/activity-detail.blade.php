@extends('layouts.main')

@section('content')
  <div class="card-group act-card-group">
    <div class="card act-card">
      <div class="card-content">
        <div class="card-title">活动信息</div>
        <div class="act-snap">
          <img src="/img/person-3.jpg" alt="Avatar" class="avatar">
          <div class="act-snap-info">
            <p class="name">{{$activity['name']}}</p>
            <p class="intro">{{$activity['begin']}} — {{$activity['end']}}</p>
          </div>
          <button class="join-btn btn waves-effect waves-light">加入</button>
        </div>
        <div class="act-info">
          <div class="act-info-item">
            <i class="material-icons medium">track_changes</i>
            <p class="info">{{$activity['type']}}</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">watch_later</i>
            <p class="info">剩余 {{$activity['left_hour']}} 小时</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">monetization_on</i>
            <p class="info">{{$activity['reward']}} 步币</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">people</i>
            <p class="info">{{$activity['people_num']}} / {{$activity['people_limit']}} 人</p>
          </div>
        </div>
      </div>
      <div class="divider"></div>
      <div class="card-content">
        <p>{{$activity['description']}}</p>
      </div>
    </div>

    <div class="card list-card rank-card">
      <div class="card-content">
        <div class="card-title">活动状态</div>
      </div>
      <ul class="tabs">
        <li class="tab"><a class="active" href="#">活动排名</a></li>
        <li class="tab"><a href="#">活动成员</a></li>
      </ul>
      <ul class="collection">
        <li class="collection-item collection-header">
          <div class="collection-col collection-col-2 user-col"></div>
          <div class="collection-col collection-col-2 count-col">完成度</div>
          <div class="collection-col rank-col">排名</div>
        </li>
        @foreach($participates as $index=>$participate)
        <li class="collection-item">
          <div class="collection-col collection-col-2 user-col">
            <img src="{{$participate['avatar_img']}}" alt="" class="avatar avatar-small">
            <p>{{$participate['name']}}</p>
          </div>
          <div class="collection-col collection-col-2 count-col">{{$participate['completed_rate']}}%</div>
          <div class="collection-col rank-col">{{$index}}</div>
        </li>
        @endforeach
      </ul>
    </div>
@stop

