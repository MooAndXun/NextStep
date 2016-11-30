<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title>Today</title>
  <link rel="stylesheet" href="/css/materialize.css">
  <link rel="stylesheet" href="/css/index.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
  </script>
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
        <li class="tab nav-tab"><a href="/home" target="_self">首页</a></li>
        <li class="tab nav-tab"><a href="/activity" target="_self">活动</a></li>
        <li class="tab nav-tab"><a href="/circle" target="_self">圈子</a></li>
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
        <li><a href="/index.html" class="collection-item">今日</a></li>
        <li><a href="/template/stat.html" class="collection-item">运动统计</a></li>
        <li><a href="/template/friend.html" class="collection-item">我的关注</a></li>
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
