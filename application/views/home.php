<?php if (!$logged_in) {

    ?>
    <div class="row">

        <div class="span7 hero-unit" style="margin-left: 10px">
            <h1>不带便当，上神马班？</h1>

            <p>还在为午饭吃什么而苦恼？还在为地沟油而担心？</p>

            <p>
                <a href="/account/register" class="btn btn-primary btn-large">
                    <strong>加入我们</strong> 注册
                </a>
            </p>
        </div>

        <div class="span4">
            <form id="lzform" class="well" name="lzform" method="post" action="/account/login">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="email">帐号</label>

                        <div class="controls">
                            <input type="text" name="email" id="email" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">密码</label>

                        <div class="controls">
                            <input name="password" id="password" type="password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="checkbox control-label">
                            <input id="remember_me" name="remember_me" type="checkbox"> 记住我
                        </label>

                        <div class="controls">
                            <input value="登录" type="submit" class="btn btn-primary ">
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
<?php
}

?>
<div class="row">

    <div class="span8 page-header">
        <h1>现在有哪些饭可以<em style="color: red">抢</em></h1>
    </div>
    <?php if ($logged_in) {
        ?>
        <div class="span3 well">
            <ul class="unstyled">
                <li><a href="/"><strong><?php echo $realname ?></strong></a></li>
                <li>帮助解决午饭问题</li>
                <li>帮助人数<em style="color: green">5</em></li>
                <li>被帮助次数<em style="color: green">5</em></li>
            </ul>
        </div>
    <?php
    }
    ?>
</div>

<div class="row">
    <div class="span8">

        <?php foreach ($posts as $post):
            foreach ($post as $item):
//                var_dump($post);
                ?>
                <div class="well row">
                    <div class="span1">
                        <ul class="unstyled">
                            <li><a href="/account/<?php echo $item->user->objectId ?>">
                                    <strong>
                                        <?php echo $item->user->realname; ?>
                                    </strong>
                                </a>
                            </li>
                            <li>
                                <?php
                                $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate->iso);
                                echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="span5">
                        <ul class="unstyled">

                            <li>带<strong><?php echo $item->name ?></strong></li>
                            <li>
                                <blockquote><?php echo $item->describe ?></blockquote>
                            </li>
                            <li>
                                总共<em style="color: green"><?php echo $item->count ?></em>份,
                                已抢出<em style="color: red"><?php echo $item->bookedCount ?></em>份,
                                还剩<em style="color: red"><?php echo $item->count - $item->bookedCount ?></em>份
                            </li>
                            <li>
                                <?php if ($item->count <= $item->bookedCount) { ?>
                                    <a href="#" class="btn disabled">没有啦，下次早点吧</a>
                                <?php
                                } elseif ($logged_in) {

                                    ?>
                                    <a href="#" data-username="<?php echo $item->user->realname; ?>"
                                       data-foodname="<?php echo $item->name; ?>"
                                       data-foodid="<?php echo $item->objectId; ?>"
                                       data-userid="<?php echo $item->user->objectId; ?>"
                                       class="btn btn-primary book-button">赶快抢订</a>
                                <?php } else { ?>
                                    <a href="/account/login" class="btn btn-primary">赶快抢订</a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php
            endforeach;
        endforeach
        ?>

    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p></p><span id="myModalBoby">One fine body…</span></p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">换一个</button>
        <button id="book-confirm" class="btn btn-primary">就她了</button>
    </div>
</div>

<form id="bookform" class="hide" name="bookform" method="post" action="/orders/create">
    <input type="text" name="foodId" id="foodId">
    <input type="text" name="foodOwnerId" id="foodOwnerId">
    <input type="text" name="foodOwnerName" id="foodOwnerName">
</form>