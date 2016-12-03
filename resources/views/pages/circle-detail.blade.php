@extends('layouts.main')

@section('content')
  <div class="card-group act-card-group">
    <div class="card act-card">
      <div class="card-content">
        <div class="act-snap">
          <img src="/img/circle_avatar/circle-1.jpg" alt="Avatar" class="avatar">
          <div class="act-snap-info">
            <p class="name">马拉松爱好者</p>
            <p class="intro">近期目标：南马</p>
          </div>
          <form method="post">
            {!! csrf_field() !!}
            <button type='submit' class="btn btn-pink join-btn waves-effect waves-light">加入</button>
          </form>
        </div>
        <div class="act-info">
          <div class="act-info-item">
            <i class="material-icons medium">watch_later</i>
            <p class="info">创建于 2016-10-10</p>
          </div>
          <div class="act-info-item">
            <i class="material-icons medium">people</i>
            <p class="info">10 / 60人</p>
          </div>

          <div class="act-info-item"></div>
          <div class="act-info-item"></div>
        </div>
      </div>
    </div>

    <div class="card">
      <ul class="tabs">
        <li class="tab"><a href="#">成员动态</a></li>
        <li class="tab"><a href="#">讨论区</a></li>
      </ul>
    </div>

    <div class="card-group friend-card-group">
      <div class="card friend-card">
        <div class="card-content">
          <img src="../img/user_avatar/person-2.jpg" alt="Avatar" class="avatar">
          <div class="user-info">
            <p class="name">Arron Hunt</p>
            <p class="intro">今天一共步行了 <b>8000</b> 步</p>
          </div>
          <div class="icon-info">
            <button class="join-btn btn waves-effect waves-light">点赞</button>
          </div>
        </div>
      </div>
      <div class="card friend-card">
        <div class="card-content">
          <img src="../img/user_avatar/person-1.jpg" alt="Avatar" class="avatar">
          <div class="user-info">
            <p class="name">Mike</p>
            <p class="intro">刚刚加入了活动 <b>南马</b></p>
          </div>
          <div class="icon-info">
            <button class="join-btn btn waves-effect waves-light">加入</button>
          </div>
        </div>
      </div>
      <div class="card friend-card">
        <div class="card-content">
          <img src="../img/user_avatar/person-3.jpg" alt="Avatar" class="avatar">
          <div class="user-info">
            <p class="name">Nick</p>
            <p class="intro">刚刚加入了圈子 <b>跑步圈</b></p>
          </div>
          <div class="icon-info">
            <button class="join-btn btn waves-effect waves-light">加入</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop