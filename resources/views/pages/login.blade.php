<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" href="/css/materialize.css">
    <link rel="stylesheet" href="/css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login</title>
</head>

<body class="login-body">
    <div class="wrapper">
        <nav class="page-nav">
            <div class="nav-wrapper">
                <h1 class="brand-logo">NextSTEP</h1>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="card login-card">
            <div class="title-block">
                <p>登录</p>
                <div class="square"></div>
                <div class="triangle"></div>
            </div>
            <form class="login-form" action="{{ url('/user/login') }}" method="post">
                {!! csrf_field() !!}
                <div class="input-field">
                    <input id="username" name="username" type="text" class="validate">
                    <label for="username">用户名</label>
                </div>
                <div class="input-field">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">密码</label>
                </div>
                <p><a href="#">忘记密码?</a></p>
                <p>还不是会员? <a href="#">注册</a></p>
                <div class="invisible"></div>
                <button type="submit'" class="btn-floating btn-large waves-effect waves-light login-btn"><i class="material-icons">keyboard_arrow_right</i></button>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src='/js/materialize.js'></script>

</html>
