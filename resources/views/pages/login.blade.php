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
                <p>LOG IN</p>
                <div class="square"></div>
                <div class="triangle"></div>
            </div>
            <form class="login-form" action="#">
                <div class="input-field">
                    <input id="username" type="text" class="validate">
                    <label for="username">Username</label>
                </div>
                <div class="input-field">
                    <input id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <p><a href="#">Forgot password?</a></p>
                <p>Not a member? <a href="#">Sign up now</a></p>
                <div class="invisible"></div>
                <a href="/index.html" class="btn-floating btn-large waves-effect waves-light login-btn"><i class="material-icons">keyboard_arrow_right</i></a>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src='/js/materialize.js'></script>

</html>
