@extends('layouts.main')

@section('content')
  <div class="card-group act-card-group">
    <div class="card act-card">
      <div class="card-content">
        <div class="card-title">@if($is_create==1)创建活动@else编辑活动@endif</div>
        <div class="divider"></div>
        <div class="card-content">
          <form action="/activity/{{$activity['id']}}" method="post">
            {!! csrf_field() !!}
            <div class="input-field">
              <input placeholder="请填入活动名" id="name" name="name" type="text" class="validate" value="{{$activity['name']}}">
              <label for="name">活动名</label>
            </div>
            <div class="input-field">
              <select id="type" name="type">
                <option value="" disabled selected>请选择活动类型</option>
                <option value="1" @if($activity['type']==1)selected = "selected"@endif>多人竞赛</option>
                <option value="2" @if($activity['type']==2)selected = "selected"@endif>目标竞赛</option>
                <option value="3" @if($activity['type']==3)selected = "selected"@endif>每日竞赛</option>
              </select>
              <label for="type">活动类型</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入活动奖励" id="reward" name="reward" type="text" class="validate" value="{{$activity['reward']}}">
              <label for="reward">活动奖励</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入人数限制" id="people_num" name="people_num" type="text" class="validate" value="{{$activity['people_num']}}">
              <label for="people_num">人数限制</label>
            </div>
            <div class="input-field">
              <input  placeholder="开始时间" id="start" name="start" type="date" class="datepicker" value="{{$activity['start']}}">
              <label for="start">开始时间</label>
            </div>
            <div class="input-field">
              <input  placeholder="结束时间" id="end" name="end" type="date" class="datepicker" value="{{$activity['end']}}">
              <label for="end">结束时间</label>
            </div>
            <div class="input-field">
              <textarea placeholder="活动描述" id="description" name="description" class="materialize-textarea">{{$activity['description']}}</textarea>
              <label for="description">活动描述</label>
            </div>
            <button type="submit" class="btn btn-pink">确认@if($is_create==1)创建@else修改@endif</button>
            <button type='button' onclick="window.location.href='/activity'" class="btn btn-second">取消</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
