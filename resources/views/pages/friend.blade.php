@extends('layouts.main')

@section('content')
  <div class="card-group friend-card-group">
    @foreach($friends as $friend)
    <div class="card friend-card">
      <div class="card-content">
        <img src="{{'img/user_avatar/'.$friend['avatar_img']}}" alt="Avatar" class="avatar">
        <div class="user-info">
          <p class="name">{{$friend['nick_name']}}</p>
          <p class="intro">{{$friend['description']}}</p>
        </div>
        <div class="icon-info">
          <i class="material-icons medium">directions_run</i>
          <p class='step-count'>{{$friend['steps']}}</p>
          <form action = "/follow/{{$friend['username']}}" method="post">
            <button type='submit' class="btn @if(!$is_mine)btn-pink join-btn@else joined-btn @endif waves-effect waves-light">@if(!$is_mine)关注@else已关注@endif</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@stop