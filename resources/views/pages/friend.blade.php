@extends('layouts.main')

@section('content')
  <div class="card-group friend-card-group">
    @foreach($friends as $friend)
    <div class="card friend-card">
      <div class="card-content">
        <img src="{{$friend['avatar_img']}}" alt="Avatar" class="avatar">
        <div class="user-info">
          <p class="name">{{$friend['nick_name']}}</p>
          <p class="intro">{{$friend['description']}}</p>
        </div>
        <div class="icon-info">
          <i class="material-icons medium">directions_run</i>
          <p class='step-count'>{{$friend['steps']}}</p>
          <a href="#"><i class="material-icons medium star-icon">star_border</i></a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@stop