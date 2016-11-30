<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title>{{$page_name}}</title>
  <link rel="stylesheet" href="/css/materialize.css">
  <link rel="stylesheet" href="/css/index.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
  </script>

  {{--变量定义--}}
<?php
    // Tab表
    $tab_table = [
            ['name'=>'首页', 'url'=>'/home', 'sub_tab'=>[
                ['name'=>'今日', 'url'=>'/home/today'],
                ['name'=>'运动统计', 'url'=>'/home/stat'],
                ['name'=>'我的关注', 'url'=>'/follow']]],
            ['name'=>'活动', 'url'=>'/activity','sub_tab'=>[
                ['name'=>'所有活动', 'url'=>'/activity'],
                ['name'=>'我的活动', 'url'=>'/activity?isMine=true']]],
            ['name'=>'圈子', 'url'=>'/circle','sub_tab'=>[
                ['name'=>'所有圈子', 'url'=>'/circle'],
                ['name'=>'我的圈子', 'url'=>'/circle?isMine=true']]]
    ];
?>
</head>

<body>
<header>
  <div class="header-wrapper">
    <nav class="page-nav">
      <div class="nav-wrapper">
        <h1 class="brand-logo">NextSTEP</h1>
        <a href="/login" class="icon-link"><i class="material-icons white-text circle">account_circle</i></a>
      </div>
    </nav>
    <div class="nav-content"></div>
    <div class="tabs-wrapper">
      <ul class="tabs nav-tabs">
        @foreach($tab_table as $index=>$tab)
        <li class="tab nav-tab"><a href="{{$tab['url']}}" class="@if($index===$tab_index){{'active'}}@endif" target="_self">{{$tab['name']}}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</header>

<div class="container">
  <div class="content-left">
    <div class="user-info-card card">
      <div class="card-content">
        <img class='avatar' src="/img/person-1.jpg" alt="User">
        <div class="data-group info-group">
          <div class="data-item info-item">
            <p>200</p>
            <p class="data-item-name info-item-name">关注</p>
          </div>
          <div class="divider"></div>
          <div class="data-item info-item">
            <p>30</p>
            <p class="data-item-name info-item-name">活动</p>
          </div>
        </div>
      </div>
    </div>

    <div class="siderbar-nav card">
      <ul class="collection">
        @foreach($tab_table[$tab_index]['sub_tab'] as $index=>$tab)
        <li><a href="{{$tab['url']}}" class="collection-item @if($index===$sub_tab_index){{'active'}}@endif">{{$tab['name']}}</a></li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="content">
    @yield('content')
  </div>
</div>

<footer class="page-footer">
  <p class="center">Made with love by Moo © 2016 Nextstep</p>
</footer>

</body>

@section('js')
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src='/js/materialize.js'></script>
<script src='/js/echarts.common.min.js'></script>
@show
</html>
