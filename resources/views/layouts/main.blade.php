<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">

  <meta name="keywords" content="下一步|运动|健康|跑步|管理|平台" />
  <meta name="description" content="Nextstep-运动健康管理平台" />

  <meta name="viewport" content="width=device-width initial-scale=1"/>

  <title>{{$page_name}}</title>
  <link rel="stylesheet" href="{{asset('/css/materialize.css')}}">
  <link rel="stylesheet" href="{{asset('/css/index.css')}}">
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
        ['name' => '首页', 'url' => '/home', 'sub_tab' => [
            ['name' => '今日', 'url' => '/home/today'],
            ['name' => '运动统计', 'url' => '/home/stat'],
            ['name' => '运动动态', 'url' => '/home/trend'],
            ['name' => '我的活动', 'url' => '/activity?isMine=true'],
            ['name' => '我的圈子', 'url' => '/circle?isMine=true'],
            ['name' => '我的关注', 'url' => '/follow?isMine=true']]],
        ['name' => '活动', 'url' => '/activity', 'sub_tab' => [
            ['name' => '所有活动', 'url' => '/activity'],
            ['name' => '我创建的活动', 'url' => '/activity?isMine=true']]],
        ['name' => '圈子', 'url' => '/circle', 'sub_tab' => [
            ['name' => '所有圈子', 'url' => '/circle'],
            ['name' => '我创建的圈子', 'url' => '/circle?isMine=true']]],
        ['name' => '权限', 'url' => '/permission', 'sub_tab' => [
            ['name' => '权限管理', 'url' => '/permission/management'],
            ['name' => '权限设置', 'url' => '/permission']]],
        ['name' => '关注', 'url' => '/follow?isMine=true', 'sub_tab' => [
            ['name' => '我的关注', 'url' => '/follow?isMine=true'],
            ['name' => '未关注的用户', 'url' => '/follow']]],
    ];

    $create_button = [
        '首页'=>false,
        '权限'=>false,
        '关注'=>false,
        '活动'=>['name'=>'创建活动', 'url'=>'/activity/create'],
        '圈子'=>['name'=>'创建圈子', 'url'=>'/circle/create']
    ]
    ?>
</head>

<body>
<header>
  <div class="header-wrapper">
    <nav class="page-nav">
      <div class="nav-wrapper">
        <a href="{{url('/login')}}" class="brand-logo">NextSTEP</a>
        <div class="nav-right">
          <a href="#" class="icon-link dropdown-button"
             data-activates='dropdown_user'
             data-alignment='right'
             data-beloworigin="true"><i class="material-icons white-text circle">account_circle</i></a>
          <ul id='dropdown_user' class='dropdown-content'>
            <li><a href="{{url('/user/edit')}}">个人信息</a></li>
            <li><a href="{{url('/login')}}">注销</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="nav-content"></div>
    <div class="tabs-wrapper">
      <ul class="tabs nav-tabs">
        @foreach($tab_table as $index=>$tab)
          <li class="tab nav-tab"><a href="{{url($tab['url'])}}" class="@if($index===$tab_index){{'active'}}@endif"
                                     target="_self">{{$tab['name']}}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</header>

<div class="container">
  <div class="content-left">
    <div class="user-info-card card">
      <div class="card-content">
        <img class='avatar' src="{{url('/img/user_avatar/'.$current_user['avatar'])}}" alt="Avatar">
        <div class="data-group info-group">
          <div class="data-item info-item">
            <p>8788</p>
            <p class="data-item-name info-item-name">日均步数</p>
          </div>
          <div class="divider"></div>
          <div class="data-item info-item">
            <p>7h</p>
            <p class="data-item-name info-item-name">日均睡眠</p>
          </div>
        </div>
        <div class="divide"></div>
      </div>
    </div>

    <div class="siderbar-nav card">
      <ul class="collection">
        @foreach($tab_table[$tab_index]['sub_tab'] as $index=>$tab)
        <li><a href="{{url($tab['url'])}}"
               class="collection-item @if($index===$sub_tab_index){{'active'}}@endif">{{$tab['name']}}</a></li>
        @endforeach
      </ul>
    </div>
    @if($create_button[$tab_table[$tab_index]['name']]&&$current_user['permission']!=1)
    <button onclick="window.location.href='{{url($create_button[$tab_table[$tab_index]['name']]['url'])}}'" class="btn btn-pink create-btn">{{$create_button[$tab_table[$tab_index]['name']]['name']}}</button>
    @endif
    @if($tab_index==0)
    <button onclick="setTimeout(Materialize.toast.bind(this, '同步成功', 2000), 1000)" class="btn btn-pink sync-btn">同步数据</button>
    @endif
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
  <script>
    var username = "{{$current_user['username']}}";
  </script>
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src='{{asset('/js/materialize.js')}}'></script>
  <script src='{{asset('/js/echarts.common.min.js')}}'></script>
  <script src='{{asset('/js/common.js')}}'></script>
@show
</html>
