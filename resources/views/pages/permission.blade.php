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
  <div class="card-group friend-card-group">
    @foreach($users as $index=>$user)
    <div class="card friend-card">
      <div class="card-content">
        <img src="../img/user_avatar/{{$user['avatar']}}" alt="Avatar" class="avatar">
        <div class="user-info">
          <p class="name">{{$user['nickname']}}</p>
          <p class="intro">{{$user['type']}}</p>
        </div>
        <div class="icon-info">
          <button class='dropdown-button btn' href='#'
                  data-activates='dropdown_{{$index}}'
                  data-alignment='right'
                  data-constrainwidth="false">更改权限</button>
          <!-- Dropdown Structure -->
          <ul id='dropdown_{{$index}}' class='dropdown-content'>
            <li><a href="#!">系统管理员</a></li>
            <li><a href="#!">初级用户</a></li>
            <li><a href="#!">高级用户</a></li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach
    {{--<div class="card friend-card">--}}
      {{--<div class="card-content">--}}
        {{--<img src="../img/user_avatar/person-2.jpg" alt="Avatar" class="avatar">--}}
        {{--<div class="user-info">--}}
          {{--<p class="name">Arron Hunt</p>--}}
          {{--<p class="intro">系统管理员</p>--}}
        {{--</div>--}}
        {{--<div class="icon-info">--}}
          {{--<a class='dropdown-button btn' href='#' data-activates='dropdown_2'>更改权限</a>--}}
          {{--<!-- Dropdown Structure -->--}}
          {{--<ul id='dropdown_2' class='dropdown-content'>--}}
            {{--<li><a href="#!">系统管理员</a></li>--}}
            {{--<li><a href="#!">初级用户</a></li>--}}
            {{--<li><a href="#!">高级用户</a></li>--}}
          {{--</ul>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card friend-card">--}}
      {{--<div class="card-content">--}}
        {{--<img src="../img/user_avatar/person-2.jpg" alt="Avatar" class="avatar">--}}
        {{--<div class="user-info">--}}
          {{--<p class="name">Arron Hunt</p>--}}
          {{--<p class="intro">高级用户</p>--}}
        {{--</div>--}}
        {{--<div class="icon-info">--}}
          {{--<a class='dropdown-button btn' href='#' data-activates='dropdown_3'>更改权限</a>--}}
          {{--<!-- Dropdown Structure -->--}}
          {{--<ul id='dropdown_3' class='dropdown-content'>--}}
            {{--<li><a href="#!">系统管理员</a></li>--}}
            {{--<li><a href="#!">初级用户</a></li>--}}
            {{--<li><a href="#!">高级用户</a></li>--}}
          {{--</ul>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card friend-card">--}}
      {{--<div class="card-content">--}}
        {{--<img src="../img/user_avatar/person-2.jpg" alt="Avatar" class="avatar">--}}
        {{--<div class="user-info">--}}
          {{--<p class="name">Arron Hunt</p>--}}
          {{--<p class="intro">初级用户</p>--}}
        {{--</div>--}}
        {{--<div class="icon-info">--}}
          {{--<a class='dropdown-button btn' href='#' data-activates='dropdown_4'>更改权限</a>--}}
          {{--<!-- Dropdown Structure -->--}}
          {{--<ul id='dropdown_4' class='dropdown-content'>--}}
            {{--<li><a href="#!">系统管理员</a></li>--}}
            {{--<li><a href="#!">初级用户</a></li>--}}
            {{--<li><a href="#!">高级用户</a></li>--}}
          {{--</ul>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
  </div>
@stop

@section('js')
  @parent
@stop