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
                    <?php if ($logged_in) {
                        ?>
                        <li>
                            <a href="/posts">我要带饭</a>
                        </li>
                        <li>
                            <a href="/orders">我抢过的饭</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <ul class="nav pull-right">
                <?php if (!$logged_in) {
                    echo '<li><a href="/account/login">登录</a></li>';
                    echo '<li><a href="/account/register">注册</a></li>';
                } else {
                    echo '<li><a href="/users/' . $userid . '">' . $realname . '</a></li>';
                    echo '<li><a href="/account/logout">退出</a></li>';
                }
                ?>
            </ul>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid">

