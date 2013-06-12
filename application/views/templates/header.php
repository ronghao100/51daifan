<!DOCTYPE html>
<html lang="en">
<head>
    <title>我要带饭</title>
    <meta charset="UTF-8">
    <link href="<?php echo base_url(); ?>application/views/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/css/datepicker.css" rel="stylesheet">
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
            <a class="brand" href="/index.php">51daifan</a>

            <div class="nav-collapse">
                <ul class="nav">
                    <li>
                        <a href="/index.php">首页</a>
                    </li>
                </ul>
            </div>

            <ul class="nav pull-right">
                <?php if (!$logged_in) {
                    echo '<li><a href="/account/login">登录</a></li>';
                    echo '<li><a href="/account/register">注册</a></li>';
                } else {
                    echo '<li><a href="/users/' . $userid . '">' . $realname . '</a></li>';
                    echo '<li><a id="i-post" title="我要带饭" href="/users/post/' . $userid . '"><i class="icon-edit"></i></a></li>';
                    echo '<li><a id="i-comment" title="我要评论" href="/users/order/' . $userid . '"><i class="icon-comment"></i></a></li>';
                    echo '<li class="dropdown">';
                    echo '<a id="i-setting" title="我的设置" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-cog"></i><b class="caret"></b></a>';
                    echo '<ul class="dropdown-menu">';
                    echo '<li><a href="/account/avatar">设置头像</a></li>';
                    echo '<li class="divider"></li>';
                    echo '<li><a href="/account/logout">退出</a></li>';
                    echo '</ul>';
                    echo '</li>';
                }
                ?>
            </ul>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>



<div class="container-fluid">

