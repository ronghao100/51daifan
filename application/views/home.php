<div class="row-fluid">

<div class="span6 offset2">
<div class="row-fluid">
    <div class="span12">
        <div id="myCarousel" class="carousel">
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="active item">
                    <img style="height: 200px" src="application/views/images/amyren.png" alt="">

                    <div class="carousel-caption">
                        <a href="/users/post/27"><h4>logo诞生，我们的美女设计师amyren。</h4></a>
                    </div>
                </div>
                <div class="item">
                    <img style="height: 200px" src="application/views/images/fanhe.jpg" alt="">

                    <div class="carousel-caption">
                        <h4>加入我们，和大家一起分享我们的爱心便当。</h4>
                    </div>
                </div>
                <div class="item">
                    <img style="height: 200px" src="application/views/images/chihuo.jpg" alt="">

                    <div class="carousel-caption">
                        <h4>想吃妹纸带的爱心便当？你邀请，我买单!</h4>
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
    <div class="span12">
        <strong>谁在分享自己的爱心便当</strong>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">

        <?php foreach ($posts as $item):
            ?>
            <div class="row-fluid" style="border-bottom: 1px solid #EAEAE2;margin-bottom: 10px">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span1" style="width:50px">
                                    <ul class="unstyled">
                                        <li><a href="/users/<?php echo $item->user ?>">
                                                <img style="height: 50px;width: 50px;"
                                                     src="<?php
                                                     if ($item->avatarThumbnail) {
                                                         echo $item->avatarThumbnail;
                                                     } else {
                                                         echo base_url() . 'application/views/images/medium_avatar.png';
                                                     }
                                                     ?>" alt="<?php echo $item->realName ?>">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="span10">
                                    <ul class="unstyled">
                                        <li>
                                            <span>
                                                <a href="/users/<?php echo $item->user ?>">
                                                    <strong>
                                                        <?php echo $item->realName ?>
                                                    </strong>
                                                </a>
                                            </span>
                                             <span style="float:right ">
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
                                        <li style="margin-bottom: 10px;margin-top: 10px">
                                            <?php
                                            $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                                            echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                            ?>
                                            </span>
                                            <span>带 <strong><?php echo $item->name ?></strong> : </span>
                                            <?php echo $item->describe ?>
                                        </li>
                                        <li>
                                <span>
                                    <?php echo $item->createdAt; ?>
                                    发布
                                </span>
                                                <span><i
                                                        class="icon-map-marker"></i><?php echo $item->address; ?></span>
                        <span style="float:right ">总共(<?php echo $item->count ?>)<i class="S_txt3">|</i>
                        还剩(<?php echo $item->count - $item->bookedCount ?>)<i class="S_txt3">|</i>
                        谁在吃(<?php echo $item->bookedCount ?>)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <?php
                        if ($item->orders) {
                            ?>
                            <div class="span10 offset1" style="margin-bottom: 15px">
                                <div class="arrow offset11">
                                    <div class="arrow_border"></div>
                                    <div class="arrow_content"></div>
                                </div>
                                <div class="row-fluid"
                                     style="background-color:#EEEEEE ;border-bottom: 1px solid #D9D9D9;">
                                    <div class="span12">
                                        <i class="icon-heart "></i>
                                        <?php
                                        $orders = $item->orders;
                                        foreach ($orders as $order):
                                            ?>
                                            <span>
                                        <a href="/users/<?php echo $order->owner ?>">
                                            <?php echo $order->ownerName ?>
                                        </a>
                                    </span>
                                        <?php
                                        endforeach
                                        ?>
                                    </div>
                                </div>
                                <?php
                                $orders = $item->orders;
                                foreach ($orders as $order):
                                    if ($order->comment) {
                                        ?>
                                        <div class="row-fluid" style="background-color:#EEEEEE ">
                                            <div class="span12">
                                            <span>
                                        <a href="/users/<?php echo $order->owner ?>">
                                            <?php echo $order->ownerName ?>
                                        </a>:
                                    </span>
                                            <span>
                                                <?php echo $order->comment ?>
                                            </span>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                endforeach
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach
        ?>
        <div class="row-fluid">
            <div class="span12 page">
                <?php echo $this->my_page->show(1); ?>
            </div>
        </div>
        </div>
    </div>

</div>


<div class="span2">
    <div class="row-fluid well-small" style="padding-top: 25px">
        <?php if (!$logged_in) {

            ?>
            <div class="span12">
                <ul class="unstyled" style="text-align: center;">
                    <li style="padding-bottom: 10px"><h3>中午要吃什么？</h3></li>
                    <li style="padding-bottom: 10px">不要再问我要吃什么了(=.=)!</li>
                    <li style="padding-bottom: 10px"><a class="btn btn-primary"
                                                        href="/account/register"><strong>立即注册</strong></a></li>
                    <li>已有账号，<a class="" href="/account/login">从这里登录>></a></li>
                </ul>
            </div>
        <?php
        } else {
            ?>
            <div class="span12" style="height: 200px">
                <span class="row-fluid">
                    <span class="span5">
                        <a href="/users/<?php echo $userid ?>">
                            <img style="height: 70px;width: 70px;" src="<?php
                            if ($avatar) {
                                echo $avatar;
                            } else {
                                echo base_url() . 'application/views/images/large_avatar.png';
                            }
                            ?>" alt="<?php echo $realname ?>">
                        </a>
                    </span>
                    <span class="span7">
                    <ul class="unstyled">
                        <li>
                            <a href="/users/<?php echo $userid ?>"><strong><?php echo $realname ?></strong></a></li>
                        </li>
                    </ul>
                        </span>
                </span>
                <span class="row-fluid">
                    <span class="span12">
                        <ul class="unstyled">
                            <li style="float: left;width: 61px;text-align: center;border-right-style: solid;border-right-width:1px;border-color:#E6E6E6">
                                <a href="/users/post/<?php echo $userid ?>"><strong
                                        style="display: block"><?php echo $post_count ?></strong><span
                                        style="color:  #333333;">带过</span></a>
                            </li>
                            <li style="float: left;width: 61px;text-align: center;border-right-style: solid;border-right-width:1px;border-color:#E6E6E6">
                                <a href="/users/order/<?php echo $userid ?>"><strong
                                        style="display: block"><?php echo $order_count ?></strong><span
                                        style="color:  #333333;">吃过</span></a>
                            </li>
                            <li style="float: left;width: 61px;text-align: center">
                                <a href="/users/recipe/<?php echo $userid ?>"><strong
                                        style="display: block"><?php echo $recipe_count ?></strong><span
                                        style="color:  #333333;">日记</span></a>
                            </li>
                        </ul>
                    </span>
                </span>
                <span class="row-fluid">
                    <span class="span12">
                        <span class="offset3"><a class="btn btn-primary" href="/posts/create"><i
                                    class="icon-edit icon-white"></i> 我要带饭</a></span>
                    </span>
                </span>
            </div>

        <?php
        }
        ?>
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
    <input type="text" name="base_url" id="base_url" value="<?php echo base_url()?>">
</form>