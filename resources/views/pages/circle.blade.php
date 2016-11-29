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
    @foreach($circles as $circle)
    <div class="card act-card">
      <div class="card-content">
        <div class="act-snap">
          <img src="{{$circle['avatar_img']}}" alt="Avatar" class="avatar">
          <div class="act-snap-info">
            <p class="name">{{$circle['name']}}</p>
            <p class="intro">{{$circle['description']}}</p>
          </div>
          <a href="/template/activity-detail.html" class="btn btn-second waves-effect waves-light">详情</a>
          <button class="join-btn btn waves-effect waves-light">加入</button>
        </div>
        <div class="act-info">
          <div class="act-info-item">
            <i class="material-icons medium">watch_later</i>
            <p class="info">创建于 {{$circle['created_at']}}</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">people</i>
            <p class="info">{{$circle['people_num']}} / {{$circle['people_limit']}} 人</p>
          </div>
          <div class="act-info-item"></div>
          <div class="act-info-item"></div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@stop