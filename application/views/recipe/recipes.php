<div class="row-fluid">

    <div class="span6 offset2">

        <div class="row-fluid">
            <div class="span12">
                <strong>我们家自己的美食</strong>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">

                <?php foreach ($recipes as $item):
                    ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid" style="border-bottom: 1px solid #EAEAE2;margin-bottom: 10px">
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
                                        </li>
                                        <li style="margin-bottom: 10px;margin-top: 10px">
                                            <?php echo $item->name ?> : <?php echo $item->des ?>
                                        </li>
                                        <li>
                                            <?php
                                            if ($item->image1) {
                                                echo "<img class='recipes_img' src='" . $item->image1 . "'/>";
                                            }
                                            if ($item->image2) {
                                                echo "<img class='recipes_img' src='" . $item->image2 . "'/>";
                                            }
                                            if ($item->image3) {
                                                echo "<img class='recipes_img' src='" . $item->image3 . "'/>";
                                            }
                                            if ($item->image4) {
                                                echo "<img class='recipes_img' src='" . $item->image4 . "'/>";
                                            }
                                            if ($item->image5) {
                                                echo "<img class='recipes_img' src='" . $item->image5 . "'/>";
                                            }
                                            if ($item->image6) {
                                                echo "<img class='recipes_img' src='" . $item->image6 . "'/>";
                                            }
                                            ?>
                                        </li>
                                        <li>
                                <span>
                                    <?php echo $item->createdAt; ?>
                                    发布
                                </span>
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


    <div class="span2">
        <div class="row-fluid well-small" style="padding-top: 25px">
            <?php if (!$logged_in) {

                ?>
                <div class="span12">
                    <ul class="unstyled" style="text-align: center;">
                        <li style="padding-bottom: 10px"><h3>晚上要吃什么？</h3></li>
                        <li style="padding-bottom: 10px">记录咱自己家做的美食(^-^)!</li>
                        <li style="padding-bottom: 10px"><a class="btn btn-primary"
                                                            href="/account/register"><strong>立即注册</strong> 记录</a></li>
                        <li>已有账号，<a class="" href="/account/login">从这里登录>></a></li>
                    </ul>
                </div>
            <?php
            } else {
                ?>
                <div class="span12">
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
                                <a href="/users/post/<?php echo $userid ?>"><strong style="display: block"><?php echo $post_count ?></strong><span style="color:  #333333;">带过</span></a>
                            </li>
                            <li style="float: left;width: 61px;text-align: center;border-right-style: solid;border-right-width:1px;border-color:#E6E6E6">
                                <a href="/users/order/<?php echo $userid ?>"><strong style="display: block"><?php echo $order_count ?></strong><span style="color:  #333333;">吃过</span></a>
                            </li>
                            <li style="float: left;width: 61px;text-align: center">
                                <a href="/users/recipe/<?php echo $userid ?>"><strong style="display: block"><?php echo $recipe_count ?></strong><span style="color:  #333333;">日记</span></a>
                            </li>
                        </ul>
                    </span>
                </span>
                <span class="row-fluid">
                    <span class="span12">
                            <span class="offset3"><a class="btn btn-primary" href="/recipes/create"><i class="icon-camera icon-white"></i> 我要记录</a></span>
                    </span>
                </span>
                </div>

            <?php
            }
            ?>
        </div>

    </div>
</div>
