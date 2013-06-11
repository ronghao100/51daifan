<div class="row-fluid">

<div class="span8">
    <div class="row-fluid">
        <div class="span12">
            <div id="myCarousel" class="carousel">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="active item">

                        <img style="height: 290px" src="application/views/images/jiujie.jpg" alt="">

                        <div class="carousel-caption">
                            <h4>中午要吃什么？</h4>

                            <p>
                                不要再问我要吃什么了(=.=)! 加入我们,立即注册!
                            </p>
                        </div>

                    </div>
                    <div class="item">
                        <img style="height: 290px" src="application/views/images/chihuo.jpg" alt="">

                        <div class="carousel-caption">
                            <h4>想吃妹纸带的爱心便当？你邀请，我买单!</h4>

                            <p>
                                只要你能邀请身边的妹纸为大家带饭，我们就帮你给妹纸的饭买单一次：）
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img style="height: 290px" src="application/views/images/fanhe.jpg" alt="">

                        <div class="carousel-caption">
                            <h4>分享你的爱心便当，你分享，我就送！</h4>

                            <p>
                                还记得上学时挂满墙壁的奖状吗，致青春，只要你带饭，我们就和你一起找回青春。
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12 page-header">
            <h1>现在有哪些饭可以<em style="color: red">抢</em></h1>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12" style="margin-left: 20px">

            <?php foreach ($posts as $item):
                ?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="well row">
                            <div class="span1">
                                <ul class="unstyled">
                                    <li><a href="/users/<?php echo $item->user ?>">
                                            <img style="height: 50px;width: 50px;"
                                                 src="<?php
                                                 if ($item->avatarThumbnail) {
                                                     echo $item->avatarThumbnail;
                                                 } else {
                                                     echo base_url().'application/views/images/medium_avatar.png';
                                                 }
                                                 ?>" alt="<?php echo $item->realName ?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="span11">
                                <ul class="unstyled">
                                    <li>
                                            <span>
                                                <a href="/users/<?php echo $item->user ?>">
                                                    <strong>
                                                        <?php echo $item->realName ?>
                                                    </strong>
                                                </a>
                                            </span>
                                            <span>
                                                <?php
                                                $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                                                echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                                ?>
                                            </span>
                                        <span>带 <strong><?php echo $item->name ?></strong></span>

                                <span class="offset4">
                                        <?php if ($item->count <= $item->bookedCount) { ?>
                                            <a href="#" class="btn disabled">亲没有啦</a>
                                        <?php
                                        } elseif ($logged_in) {

                                            ?>
                                            <a href="#"
                                               data-username="<?php echo $item->realName; ?>"
                                               data-foodname="<?php echo $item->name; ?>"
                                               data-foodid="<?php echo $item->objectId; ?>"
                                               data-userid="<?php echo $item->user; ?>"
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
                                    <?php echo $item->createdAt; ?>
                                    发布
                                </span>
                        <span class="offset5">总共(<?php echo $item->count ?>)<i class="S_txt3">|</i>
                        还剩(<?php echo $item->count - $item->bookedCount ?>)<i class="S_txt3">|</i>
                        <a class='booked_persons_link' onclick="return false" data-baseUrl="<?php echo base_url(); ?>"
                           data-foodid="<?php echo $item->objectId; ?>" href="#">已抢出(<?php echo $item->bookedCount ?>
                            )</a></span>
                                    </li>
                                    <li class='booked_persons_span' data-isGetData=false
                                        id="booked_persons_<?php echo $item->objectId; ?>">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach
            ?>

        </div>
    </div>

</div>


<div class="span4">
    <div class="row-fluid">
        <?php if (!$logged_in) {

            ?>
            <div class="span12">
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
        <?php
        } else {
            ?>
            <div class="span12 well">
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

    <div class="row-fluid">
        <div class="span12 well">
            <div class="roll-data">
                <ul>
                    <?php foreach ($comments as $item):
                        ?>
                        <li>
                            <a href="/users/<?php echo $item->owner ?>">
                                <strong>
                                    <?php echo $item->ownerName; ?>
                                </strong>
                            </a>
                            对
                            <a href="/users/<?php echo $item->foodOwner ?>">
                                <strong>
                                    <?php echo $item->foodOwnerName; ?>
                                </strong>
                            </a>
                            说:<br>
                            <?php echo $item->comment; ?>
                        </li>
                    <?php
                    endforeach
                    ?>
                </ul>
            </div>
        </div>
    </div>
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