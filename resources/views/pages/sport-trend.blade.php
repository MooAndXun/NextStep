@extends('layouts.main')

@section('content')
  <div class="card-group friend-card-group">
    @foreach($data as $step)
    <div class="card friend-card">
      <div class="card-content">
        <img src="../img/user_avatar/{{$current_user['avatar']}}" alt="Avatar" class="avatar">
        <div class="user-info">
          <p class="name">{{$current_user['username']}}</p>
          <p class="intro">于 <b>{{$step['date']}}</b> 步行了 <b>{{$step['steps']}}</b> 步</p>
        </div>
      </div>
    </div>
      @endforeach
  </div>
@stop