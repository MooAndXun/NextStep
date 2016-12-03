@extends('layouts.main')

@section('content')
  <div class="card-group act-card-group">
    <div class="card act-card">
      <div class="card-content">
        <div class="card-title">@if($is_create==1)创建活动@else编辑活动@endif</div>
        <div class="divider"></div>
        <div class="card-content">
          <form action="/activity/create" method="post">
            <div class="input-field">
              <input placeholder="请填入活动名" id="nick_name" type="text" class="validate" value="{{$circle['name']}}">
              <label for="nick_name">活动名</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入活动奖励" id="height" type="text" class="validate" value="{{$circle['reward']}}">
              <label for="height">活动奖励</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入人数限制" id="weight" type="text" class="validate" value="{{$circle['people_num']}}">
              <label for="weight">人数限制</label>
            </div>
            <button type="submit" class="btn btn-pink">创建活动</button>
            <button onclick="window.location.href='/activity'" class="btn btn-second">取消</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
