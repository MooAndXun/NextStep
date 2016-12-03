@extends('layouts.main')

@section('content')
  <div class="card-group act-card-group">
    <div class="card act-card">
      <div class="card-content">
        <div class="card-title">编辑用户信息</div>
        <div class="divider"></div>
        <div class="card-content">
          <form action="/user/info" method="post">
            {!! csrf_field() !!}
            <div class="input-field">
              <input placeholder="请填入昵称" id="nick_name" name="nick_name" type="text" class="validate" value="{{$current_user['nick_name']}}">
              <label for="nick_name">昵称</label>
            </div>
            <div class="input-field">
              <textarea placeholder="请填入个性签名" id="description" name="description" class="materialize-textarea">{{$current_user['description']}}</textarea>
              <label for="description">个性签名</label>
            </div>
            <div class="input-field">
              <select id="gender" name="gender">
                <option value="" disabled selected>请选择性别</option>
                <option value="1" @if($current_user['gender']==1)selected = "selected"@endif>男</option>
                <option value="0" @if($current_user['gender']==0)selected = "selected"@endif>女</option>
              </select>
              <label for="gender">性别</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入身高" id="height" name="height" type="text" class="validate" value="{{$current_user['height']}}">
              <label for="height">身高</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入体重" id="weight" name="weight" type="text" class="validate" value="{{$current_user['weight']}}">
              <label for="weight">体重</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入步数目标" id="step_goal" name="step_goal" type="text" class="validate" value="{{$current_user['step_goal']}}">
              <label for="step_goal">每日步数目标</label>
            </div>
            <div class="input-field">
              <input placeholder="请填入体重目标" id="weight_goal" name="weight_goal" type="text" class="validate" value="{{$current_user['weight_goal']}}">
              <label for="weight_goal">体重目标</label>
            </div>
            <button type="submit" class="btn btn-pink">更改信息</button>
            <button type="button" onclick="window.location.href='/home'" class="btn btn-second">取消</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
