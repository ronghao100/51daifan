<!DOCTYPE html>
<html lang="en">
<head>
    <title>我要带饭</title>
    <meta charset="UTF-8">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px;
        }
    </style>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="/index.php">我要带饭</a>

            <div class="nav-collapse collapse pull-right">
                <ul class="nav">
                    <?php if (!$logged_in)
                    {
                        echo '<li><a href="/account/login">登录</a></li>';
                        echo '<li><a href="/account/register">注册</a></li>';
                    }else{
                        echo '<li><a href="/account/'.$userid.'">'.$realname.'</a></li>';
                        echo '<li><a href="/account/logout">退出</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">

