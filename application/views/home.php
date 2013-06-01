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
                <li><a href="/users/<?php echo $userid ?>"><strong><?php echo $realname ?></strong></a></li>
                <li>带过 <a href="/posts"><?php echo $post_count ?></a></li>
                <li>吃过 <a href="/orders"><?php echo $order_count ?></a></li>
                <li>帮助人数 <em style="color: green"><?php echo $order_count ?></em></li>
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
//                var_dump($item);
                ?>
                <div class="span8">
                    <div class="well row">
                        <div class="span1">
                            <ul class="unstyled">
                                <li><a href="/users/<?php echo $item->user->objectId ?>">
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
                        <div class="span6">
                            <ul class="unstyled">

                                <li>
                                    <span>带<strong><?php echo $item->name ?></strong></span>
                                </li>
                                <li>
                                <span class="offset4">
                                        <?php if ($item->count <= $item->bookedCount) { ?>
                                            <a href="#" class="btn disabled">亲没有啦</a>
                                        <?php
                                        } elseif ($logged_in) {

                                            ?>
                                            <a href="#"
                                               data-username="<?php echo $item->user->realname; ?>"
                                               data-foodname="<?php echo $item->name; ?>"
                                               data-foodid="<?php echo $item->objectId; ?>"
                                               data-userid="<?php echo $item->user->objectId; ?>"
                                               class="btn btn-primary book-button">赶快抢订</a>
                                        <?php } else { ?>
                                            <a href="/account/login"
                                               class="btn btn-primary">赶快抢订</a>
                                        <?php } ?>
                                </span>
                                </li>
                                <li>
                                    <blockquote><?php echo $item->describe ?></blockquote>
                                </li>
                                <li>
                                <span>
                                    <?php
                                    $createDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->createdAt);
                                    echo $createDate['month'] . '-' . $createDate['day'] . ' ' . $createDate['hour'] . ':' . $createDate['minute'];
                                    ?>
                                    发布
                                </span>
                        <span class="offset2">总共(<?php echo $item->count ?>)<i class="S_txt3">|</i>
                        还剩(<?php echo $item->count - $item->bookedCount ?>)<i class="S_txt3">|</i>
                        <a class='booked_persons_link' onclick="return false" data-baseUrl="<?php echo base_url(); ?>" data-foodid="<?php echo $item->objectId; ?>" href="#">已抢出(<?php echo $item->bookedCount ?>)</a></span>
                                </li>
                                <li class='booked_persons_span' data-isGetData=false id="booked_persons_<?php echo $item->objectId; ?>">
                                </li>
                            </ul>
                        </div>
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