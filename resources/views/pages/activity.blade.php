@extends('layouts.main')

@section('content')
  <nav class="search-nav">
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>

  <div class="card-group act-card-group">
    @foreach($activities as $activity)
    <div class="card act-card">
      <div class="card-content">
        <div class="act-snap">
          <img src="{{'/img/activity_avatar/'.$activity['avatar']}}" alt="Avatar" class="avatar">
          <div class="act-snap-info">
            <p class="name">{{$activity['name']}}</p>
            <p class="intro">{{$activity['start']}} — {{$activity['end']}}</p>
          </div>
          <button onclick="window.location.href = '/activity/{{$activity['id']}}'" class="btn btn-second waves-effect waves-light">详情</button>
          <form name='joinForm{{$activity['id']}}' action = "/activity/join/{{$activity['id']}}/{{$current_user['username']}}" method="post">
            {!! csrf_field() !!}
            <button type='submit' class="btn btn-pink join-btn waves-effect waves-light">加入</button>
          </form>
        </div>
        <div class="act-info">
          <div class="act-info-item">
            <i class="material-icons medium">track_changes</i>
            <p class="info">{{$activity['type']}}</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">watch_later</i>
            <p class="info">剩余 {{$activity['left-time']}} 小时</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">monetization_on</i>
            <p class="info">{{$activity['reward']}} 步币</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">people</i>
            <p class="info">{{$activity['people_now']}} / {{$activity['people_num']}} 人</p>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@stop

@section('js')
  @parent
  <script src='/js/activity.js'></script>
@stop